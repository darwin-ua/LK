<?php

// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use App\Models\Doing;
use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Shedule;
use App\Models\PortfolioFoto;
use App\Models\Order;
use App\Models\Timework;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Models\Like;
use App\Models\LessonType;
use Illuminate\Support\Facades\Http;
use App\Models\Region;
use App\Models\Town;
use Illuminate\Support\Facades\DB;
use App\Models\Statistic;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;



class EventController extends Controller
{
    public function index(Request $request)
    {
        $temporaryUserId = $request->session()->get('temporaryUserId');

        $events = Event::all();
        return view('events.index', compact('events'));
    }

    public function Shedule($id)
    {
        $schedule = Shedule::find($id);
        if ($schedule) {
            return $schedule->reserv;
        } else {
            return "Запись с ID $id не найдена в таблице schedules.";
        }
    }

    public function all()
    {
        $regions = Region::take(100)->get();

        $cities = [];
        if ($regions->isNotEmpty()) {
            $firstRegion = $regions->first();
            $cities = $firstRegion->towns;
        }

        $currentLocale = session('locale', config('app.locale'));
        App::setLocale($currentLocale);

        $events = Event::with('shedule')
            ->where('status', 1)
            ->paginate(8);

        $user = User::where('id', 1)->where('role_id', 1)->first();
        $phone = $user->phone;

        // Получаем количество товаров в корзине для текущей сессии
        $sessionId = session()->getId();
        $uuid = request()->cookie('uuid') ?: \Illuminate\Support\Str::uuid();
        //$cartCount = Product::where('uuid', $uuid)->count();
        $cartCount = Product::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                // Если пользователь авторизован, добавляем товары с его user_id
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        $likeCount = Like::where('hash', $sessionId)->count();
        $cartDoingCount = Doing::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->count();

        $events->transform(function ($event) {
            $event->short_description = Str::limit(strip_tags($event->description), 270);

            // Получение первого изображения для события
            $firstImage = PortfolioFoto::where('event_id', $event->id)->first();
            if ($firstImage) {
                $event->first_image_path = asset('files/' . $event->user_id . '/' . $event->id . '/' . $firstImage->title);
            } else {
                $event->first_image_path = null;
            }

            if ($event->shedule) {
                $event->reserv = $event->shedule->reserv;
            } else {
                $event->reserv = 0;
            }

            return $event;
        });

        return view('events.all', compact('events', 'cartCount', 'cartDoingCount', 'phone', 'likeCount', 'currentLocale', 'regions', 'cities'));
    }

    public function getSubCategories($categoryId)
    {
        $subCategories = DB::table('categories_ua')
            ->where('select_id', $categoryId)
            ->where('status', 1)
            ->get(['id', 'title']);

        return response()->json(['subCategories' => $subCategories]);
    }


    public function getCitiesByRegion(Request $request, $region)
    {
        $cities = Region::findOrFail($region)->towns;

        return response()->json($cities);
    }

    public function handleLike(Request $request)
    {
        // Проверка заголовка Referer
        $referer = $request->headers->get('referer');
        $origin = $request->headers->get('origin');

        // Определите URL вашего сайта
        $allowedReferer = config('app.url');

        // Проверяем, что запрос пришел с вашего сайта (Referer или Origin должен быть равен вашему URL)
        if (!$referer || !$origin || !str_contains($referer, $allowedReferer) || !str_contains($origin, $allowedReferer)) {
            return response()->json(['error' => 'Unauthorized request'], 403);
        }

        // Стандартная логика для обработки лайков
        $eventId = $request->input('event_id');
        $sessionHash = $request->session()->getId();
        $userId = auth()->id();

        if (auth()->check()) {
            $userId = auth()->id();
        } else {
            $userId = null;
            $request->session()->put('temporaryUserId', $sessionHash);
        }

        $like = Like::where('event_id', $eventId)
            ->where('user_id', $userId)
            ->where('hash', $sessionHash)
            ->first();

        if ($like) {
            $like->update(['liked' => true]);
        } else {
            $like = Like::create([
                'event_id' => $eventId,
                'user_id' => $userId,
                'hash' => $sessionHash,
                'liked' => true
            ]);
        }

        return response()->json(['success' => true]);
    }


    public function handleLikeNo(Request $request)
    {
        // Проверка заголовка Referer
        $referer = $request->headers->get('referer');
        $origin = $request->headers->get('origin');

        // Определите URL вашего сайта
        $allowedReferer = config('app.url');

        // Проверяем, что запрос пришел с вашего сайта (Referer или Origin должен быть равен вашему URL)
        if (!$referer || !$origin || !str_contains($referer, $allowedReferer) || !str_contains($origin, $allowedReferer)) {
            return response()->json(['error' => 'Unauthorized request'], 403);
        }


        $eventId = $request->input('event_id');
        $sessionHash = $request->session()->get('uuid');
        $userId = auth()->id();

        if (auth()->check()) {
            $userId = auth()->id();
        } else {
            $userId = null;
            $request->session()->put('temporaryUserId', $sessionHash);
        }

        $like = Like::where('event_id', $eventId)
            ->where(function ($query) use ($userId, $sessionHash) {
                $query->where('user_id', $userId)
                    ->orWhere('hash', $sessionHash);
            })
            ->first();

        if ($like) {
            $like->delete();
            return response()->json(['success' => true, 'message' => 'Like removed']);
        } else {
            return response()->json(['success' => false, 'message' => 'Like not found']);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    public function show(Request $request,$id,$code=null)
    {

        $this->middleware(function ($request, $next) {
            $locale = session('locale', config('app.locale'));
            App::setLocale($locale);
            return $next($request);
        });

        // Получаем параметр redirect из запроса
        $redirect = $request->input('redirect');

        // Проверяем, является ли пользователь гостем и был ли передан параметр redirect
        if ($redirect === 'guest') {
         $event_quest = $redirect ;
        }else{
            $event_quest = false;
        }


        $event = Event::find($id);
        $event_type_pay = $event->type_pay;
        $event_amount = $event->amount;
        $event_discount = $event->discount;
        $eve_title=$event->title;
        $eve_id=$event->id;
        $eve_categ=$event->category;

        if ($event) {
            $userId = $event->user_id;
            $events = Event::where('user_id', $userId)
                ->whereNotIn('id', [$id])
                ->take(7)
                ->get();
        } else {
            $events = collect();
        }

        if (!$event) {
            return abort(404);
        }

        $patch = isset($_SERVER["HTTP_HOST"]) && isset($_SERVER["REQUEST_URI"]) ? $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] : null;
        $client = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : null;
        $ip = isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : null;
        $event_id = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : null;


        $data = [
            [
                'patch' => $patch,
                'client' => $client,
                'ip' => $ip,
                'event_id' => $event_id
            ],
        ];

        $response = Http::withToken('00bfb1b61d5be4e997abd77f16fce984')
            ->post('http://88.218.28.99:3000/api/statistics', $data);

        \Log::info('Response from Node.js server:', ['status' => $response->status(), 'body' => $response->body()]);

        if (!$response->successful()) {
            \Log::error('Error sending data to Node.js server:', ['status' => $response->status(), 'body' => $response->body()]);
            return response('Ошибка при отправке данных на сервер Node.js', 500);
        }

        $user = $event->user;
        $images = PortfolioFoto::where('event_id', $id)->get();
        $imageData = [];

        foreach ($images as $image) {
            $filePath = public_path('files/' . $event->user_id . '/' . $id . '/' . $image->title);

            if (file_exists($filePath)) {
                $imageData[] = (object)[
                    'path' => asset('files/' . $event->user_id . '/' . $id . '/' . $image->title),
                    'description' => $image->description,
                ];
            }
        }

        $eventss = Event::where('user_id', $userId)
            ->whereNotIn('id', [$id])
            ->take(9)
            ->get();


        $firstImages = [];
        foreach ($eventss as $eventt) {
            $firstImage = PortfolioFoto::where('event_id', $eventt->id)->first();
            if ($firstImage) {
                $firstImages[$eventt->id] = (object)[
                    'path' => asset('files/' . $eventt->user_id . '/' . $eventt->id . '/' . $firstImage->title),
                ];
            }
        }

        $shedule = Shedule::where('event_id', $id)->first();

        if ($shedule) {
            $reserv = $shedule->reserv;
            $time = $shedule->time;
            $mono = $shedule->mono;
            $datapicker = $shedule->datapicker;
        } else {
            $reserv = 'Default Value';
            $time = null;
            $mono = null;
            $datapicker = null;
        }

        $busyDates = [];

        if ($mono == 1) {
        } else {
            $busyDates = Order::where('order_id', $event->id)->pluck('order_date')->toArray();
        }

        $formattedBusyDates = [];

        if (!empty($busyDates)) {
            foreach ($busyDates as $date) {
                try {
                    $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
                    $formattedBusyDates[] = $formattedDate;
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        $lessonType = LessonType::where('events_id', $event->id)
            ->orderBy('updated_at', 'desc')
            ->first();

        $timeworks = Timework::join('shedules', 'timeworks.shedule_id', '=', 'shedules.id')
            ->where('shedules.event_id', $id)
            ->get();

        // Получаем все события для текущего пользователя
        $allEvents = Event::where('user_id', $userId)->get();

        // Извлекаем и группируем все субкатегории
        $subCategories = collect();
        foreach ($allEvents as $evt) {
            $subCat = json_decode($evt->sub_category, true);
                $subCategories = $subCategories->merge($subCat);
        }
        // Группируем по значению
        $groupedSubCategories = $subCategories->groupBy(function($item) {
            return $item;
        });

        // Получаем названия субкатегорий
        $subCategoryTitles = \DB::table('categories_sub_ua')
            ->whereIn('id', $groupedSubCategories->keys())
            ->pluck('title', 'id');

        // Подготовка данных для отображения
        $subCategoryData = $groupedSubCategories->mapWithKeys(function($items, $key) use ($subCategoryTitles) {
            return [$subCategoryTitles[$key] => $items->count()];
        });

        $sessionId = session()->getId();
        $uuid = request()->cookie('uuid') ?: \Illuminate\Support\Str::uuid();
        //$cartCount = Product::where('uuid', $uuid)->count();
        $cartCount = Product::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                // Если пользователь авторизован, добавляем товары с его user_id
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        $cartDoingCount = Doing::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->count();
        // Получаем количество лайков для текущей сессии
        $likeCount = Like::where('hash', $sessionId)->count();

        $qrOptions = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
        ]);

        foreach ($events as $event) {
            $qrcode = new QRCode($qrOptions);
            $qrCodeData = $qrcode->render('/' . $event->id);
            $event->qrCodeData = $qrCodeData;
        }

       return view('events.show', compact('event','eve_categ', 'eve_id','eve_title', 'event_quest', 'eve_id',  'qrCodeData',  'firstImages', 'cartDoingCount','cartCount', 'likeCount', 'id', 'event_type_pay', 'subCategoryData', 'event_discount', 'event_amount', 'events','lessonType', 'reserv', 'time', 'imageData', 'formattedBusyDates', 'user', 'timeworks', 'datapicker'));

      //  return view('events.show', compact('event', 'event_type_pay', 'event_discount', 'event_amount', 'events','lessonType', 'reserv', 'time', 'imageData', 'formattedBusyDates', 'user', 'timeworks', 'datapicker'));

    }

    public function edit($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return abort(404);
        }
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'foto' => 'required|string',
            // Другие правила валидации...
        ]);

        $event = Event::find($id);
        if (!$event) {
            return abort(404);
        }

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return abort(404);
        }

        $event->update(['status' => 0]);

        return redirect()->route('admin.events.index')->with('success', 'Event status updated successfully');
    }

}
