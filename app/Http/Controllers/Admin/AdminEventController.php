<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\Marker;
use App\Models\Region;
use App\Models\SheduleDetail;
use App\Models\Timework;
use App\Models\User;
use App\Models\Lesson;
use App\Models\LessonType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Models\Shedule;
use App\Models\Statistic;
use App\Models\PortfolioFoto;
use Illuminate\Support\Facades\DB;
use App\Models\LessonFile;
use App\Models\Town;
use App\Models\Video;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Subcategory;






class AdminEventController extends Controller
{
    public function deactivate($id)
    {
        $event = Event::findOrFail($id);
        $event->activate = 0; // Меняем activate на 0
        $event->status = 0;
        $event->save();

        return response()->json(['success' => true]);
    }

    public function activate($id)
    {
        $event = Event::findOrFail($id);
        $event->status = 1;
        $event->activate = 1;
        $event->save();

        return response()->json(['success' => true]);
    }

    public function deleteFoto(Request $request)
    {

        $fileName = $request->input('fileName');
        $fileExists = true;

        if ($fileExists) {
            return response()->json(['success' => true, 'fileName' => $fileName]);
        } else {
            return response()->json(['success' => false, 'error' => 'File not found'], 404);
        }
    }

    public function deleteFotoRedact(Request $request)
    {
        $fileName = $request->input('fileName');

        // Находим фото по имени
        $foto = PortfolioFoto::where('title', $fileName)->first();

        if (!$foto) {
            return response()->json(['success' => false, 'error' => 'File not found in DB'], 404);
        }

        // Формируем путь к файлу
        $filePath = public_path('files/' . $foto->event->user_id . '/' . $foto->event_id . '/' . $foto->title);

        // Удаляем файл, если существует
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Удаляем запись из базы
        $foto->delete();

        return response()->json(['success' => true, 'fileName' => $fileName]);
    }

    public function index()
    {
        $currentAdmin = auth()->user();

        $events = Event::where('user_id', $currentAdmin->id)
            ->where('status', '!=', 0)
            ->where('activate', '!=', 0)
            ->paginate(10000);

        $admins = User::where('role_id', 1)->get();

        $qrOptions = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
        ]);

        foreach ($events as $event) {
            $qrcode = new QRCode($qrOptions);
            $qrCodeData = $qrcode->render('/' . $event->id);
            $event->qrCodeData = $qrCodeData;
        }

        return view('admin.events.index', compact('admins', 'currentAdmin', 'events'));
    }

    public function settings()
    {
        $admins = User::where('role_id', 1)->get();

        $currentAdmin = auth()->user();
        if ($currentAdmin->role_id == 1) {
            $events = Event::paginate(10); // убрано where('status', 1)
        } elseif ($currentAdmin->role_id == 3 || $currentAdmin->role_id == 2) {
            $events = Event::where('user_id', $currentAdmin->id)
                ->paginate(10); // убрано where('status', 1)
        }

        $qrOptions = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
        ]);

        foreach ($events as $event) {
            $qrcode = new QRCode($qrOptions);
            $qrCodeData = $qrcode->render('/' . $event->id);
            $event->qrCodeData = $qrCodeData;
        }

        return view('admin.events.settings', compact('admins', 'currentAdmin', 'events'));
    }

    public function statistic()
    {
        $admins = User::where('role_id', 1)->get();

        $currentAdmin = auth()->user();
        if ($currentAdmin->role_id == 1) {
            $events = Event::where('status', 1)->paginate(10);
        } elseif ($currentAdmin->role_id == 3 or $currentAdmin->role_id == 2) {
            $events = Event::where('user_id', $currentAdmin->id)
                ->where('status', 1)
                ->paginate(10);
        }
        $qrOptions = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
        ]);

        foreach ($events as $event) {
            $qrcode = new QRCode($qrOptions);
            $qrCodeData = $qrcode->render('/' . $event->id);
            $event->qrCodeData = $qrCodeData;
        }

        return view('admin.events.statistic', compact('admins', 'currentAdmin', 'events'));
    }

    public function lesson($id)
    {
        $currentAdmin = auth()->user();
        $user = Auth::user();
        $admins = User::where('role_id', 1)->get();
        $events = Event::all();
        $event = Event::findOrFail($id);
        $scheduleExists = Shedule::where('event_id', $id)->where('status', 1)->exists();
        $sheduleRes = $scheduleExists ? 1 : 0;
        $schedules = [];
        foreach ($admins as $admin) {
            $schedules[$admin->id] = Shedule::where('event_id', $id)->where('status', 1)->get();
        }

        return view('admin.events.lesson', compact('admins', 'currentAdmin', 'event', 'events', 'schedules', 'sheduleRes'));
    }

    public function lessonSaveData(Request $request)
    {

        $user = Auth::user();
        $additional_fields = json_decode($request->additional_fields, true);

        $files = $request->file('allfoto'); // Получаем массив файлов
        foreach ($additional_fields as $index => $field) {
            $event = new Lesson();
            $event->user_id = $user->id;
            $event->events_id = $request->eventId;
            $event->lesson_chapter = $index;
            $event->terms = $request->title;
            $event->title = $field['value'];

            // Динамическое получение описания, как обсуждалось ранее
            $descriptionKey = "description_" . $index;
            $eventDescription = $request->input($descriptionKey);
            $event->description = $eventDescription ? $eventDescription : 'Значение по умолчанию';

            if (isset($files[$index])) { // Проверяем, существует ли файл для текущего индекса
                $file = $files[$index]; // Получаем файл для текущего события
                $foto_title = $file->getClientOriginalName(); // Получаем оригинальное имя файла
                $event->foto_title = $foto_title;
            } else {
                $event->foto_title = 'default_name.jpg'; // Или другое значение по умолчанию
            }

            $event->updated_at = now();
            $event->created_at = now();
            $additional_fields = json_decode($request->additional_fields);
            $event->add_fields = json_encode($additional_fields);
            $event->save();
        }

        return redirect()->route('admin.events.lesson', ['id' => $event->events_id])->with('success', 'Event created successfully');

    }

    public function uploadVideo(Request $request)
    {
        $user = Auth::user();
        $videoFiles = $request->file('allvideo');
        $fieldIndex = $request->input('fieldIndex');
        $eventId = $request->input('eventId');
        $uploadedFilesInfo = [];

        foreach ($videoFiles as $file) {

            $path = $file->store('public/videos');
            $generatedFileName = basename($path);
            $lessonFile = new LessonFile();
            $lessonFile->user_id = 1;
            $lessonFile->events_id = $eventId;
            $lessonFile->lesson_chapter = $fieldIndex;
            $lessonFile->text = $generatedFileName;
            $lessonFile->status = 1;
            $lessonFile->save();

            $uploadedFilesInfo[] = [
                'originalName' => $file->getClientOriginalName(),
                'generatedName' => $generatedFileName
            ];
        }

        return response()->json([
            'message' => 'Files uploaded successfully!',
            'files' => $uploadedFilesInfo
        ]);
    }

    public function searchTown($number){

        $crimeaRegionCode = $number;

        $crimeaRegionCode = $number; // первые две цифры


        $citiesOfCrimea = Town::where('code', 'like', $crimeaRegionCode . '%')->get();

        return $citiesOfCrimea;
    }

    public function create()
    {
        $currentAdmin = auth()->user();
        $user = Auth::user();
        $admins = User::where('role_id', 1)->get();
        $events = Event::all();
        $scheduleExists = Shedule::where('user_id', $user->id)->where('status', 0)->orWhere('status', 1)->exists();
        $sheduleRes = $scheduleExists ? 1 : 0;
        $regions = Region::take(100)->get();

        $cities = [];
        if ($regions->isNotEmpty()) {
            $firstRegion = $regions->first();
            $cities = $firstRegion->towns;
        }

        $schedules = [];
        foreach ($admins as $admin) {
            $schedules[$admin->id] = Shedule::where('user_id', $user->id)->where('status', 0)->orWhere('status', 1)->get();
        }

        return view('admin.events.create', compact('admins', 'currentAdmin', 'regions', 'events', 'schedules', 'sheduleRes'));
    }

    function generateSlug($string)
    {
        $slug = preg_replace('/[^A-Za-z0-9]+/u', '-', $string);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = mb_strtolower($slug);
        return $slug;
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $event = $this->createEvent($request, $user);

        if ($event) {

            $this->processAllFotos($request->file('allfoto'), $user, $event->id);
            return response()->json(['status' => 'ok']); // ❗ возвращаем JSON

        }

        return response()->json(['status' => 'error', 'message' => 'Не удалось создать событие'], 500);

    }

    protected function createEvent($request, $user)
    {
        try {
            $event = new Event();
            $event->user_id = $user->id;
            $event->title = $request->title;
            $event->middlename = $request->middlename;
            $event->surname = $request->surname;
            $event->specialization = $request->specialization;
            $event->category = (int)($request->input('category', 0));
            $event->sub_category = (int)($request->input('sub_category', 0));
            $event->town_id = $request->town;
            $event->piple = $request->piple;
            $event->data_create_order = '';
            $event->description = $request->input('description');
            $event->slug = $this->generateSlug($request->title);
            $event->type_pay = $request->type_pay;
            $event->phone = $request->phone;
            $currency = $request->input('currency', 0);
            $event->currency = (is_numeric($currency) ? (int)$currency : 0);
            $event->start_date = $request->shedule_date_from;
            $event->end_date = $request->shedule_date_to;
            $event->nameButton = $request->nameButton;
            $event->amount = $request->amount;
            $event->youtube_link = '';
            $event->telegram_link = '';
            $event->x_link = '';
            $event->instagram_link = '';
            $event->foto_folder_id = $request->foto_folder_id;
            $event->discounte = $request->input('discount');
            $event->updated_at = now();
            $event->created_at = now();
            $event->status = 1;
            // ✅ Безопасный JSON
            $additional_fields = json_decode($request->additional_fields ?? '[]', true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Некорректный JSON в additional_fields', [
                    'raw' => $request->additional_fields,
                    'error' => json_last_error_msg(),
                ]);
                $additional_fields = [];
            }
            $event->add_fields = json_encode($additional_fields);

            $event->is_live = $request->input('is_live', '');
            $event->is_links = $request->input('is_links', '');

            $event->save();

            // 🎥 Видеоссылки
            if ($request->has('videoLinks')) {
                foreach ($request->videoLinks as $videoLink) {
                    if (!empty($videoLink)) {
                        $youtube_id = $this->extractYouTubeID($videoLink);
                        if ($youtube_id) {
                            Video::create([
                                'event_id' => $event->id,
                                'youtube_id' => $youtube_id,
                                'title' => 'Видео для ' . $event->title,
                                'description' => 'Автоматически добавленное видео',
                            ]);
                        }
                    }
                }
            }

            // 📂 Создание директорий
            $userFolder = public_path('storage/files/' . $user->id);
            if (!file_exists($userFolder)) {
                mkdir($userFolder, 0777, true);
            }

            $eventFolder = $userFolder . '/' . $event->id;
            if (!file_exists($eventFolder)) {
                mkdir($eventFolder, 0777, true);
            }

            return $event;

        } catch (\Throwable $e) {
            Log::error('Ошибка при создании события', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);
            abort(500, 'Внутренняя ошибка сервера. Обратитесь к администратору.');
        }
    }

    protected function detectCategoryAndSubcategory($title)
    {
        $apiKey = env('OPENAI_API_KEY');

        try {
            $response = Http::withToken($apiKey)->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => [
                    ['role' => 'system', 'content' => 'Определи ПОДКАТЕГОРИЮ, к которой относится событие. Выбирай СТРОГО из предложенных подкатегорий. Выведи только ПОДКАТЕГОРИЮ'],
                    ['role' => 'user', 'content' => 'Категории: События: Собрания и митапы, Выставки и ярмарки, Религиозные мероприятия, Онлайн-события и вебинары. Медицинские и оздоровительные услуги: Терапевты и врачи, УЗИ, анализы и диагностика, Стоматология, Психотерапия и коучинг, Центры реабилитации, Массаж и мануальная терапия, Йога и медитация. Красота и уход: Парикмахерские услуги, Маникюр и педикюр, Косметологические процедуры, СПА и релакс, Макияж и визаж, Перманент и татуаж, Лазерная эпиляция. Образование и развитие: Языковые курсы, Школьные предметы и репетиторы, Профориентация и развитие карьеры, IT и программирование, Курсы для детей, Подготовка к экзаменам. Питание и гастрономия: Доставка еды, Кулинарные курсы, Рестораны и кафе, Диетология и консультации, Фуд-корты и кейтеринг. Дом и быт: Ремонт и отделка, Уборка и клининг, Сантехники и электрики, Доставка воды и бытовых услуг, Вывоз мусора и переезд. Авто и транспорт: Шиномонтаж и СТО, Аренда авто, Эвакуация и техпомощь, Продажа и обслуживание, Страхование авто. Магазины и торговля: Одежда и обувь, Электроника, Цветы и подарки, Канцелярия и книги, Детские товары, Зоотовары. Финансы и право: Бухгалтерские услуги, Юридические консультации, Нотариус, Налоги и аудит. Детские услуги: Садики и ясли, Кружки и секции, Аниматоры и праздники, Логопеды и психологи. Животные и уход за ними: Ветеринарные клиники, Груминг и стрижка, Передержка и гостиницы, Дрессировка, Выгул животных. Логистика и доставка: Курьерские службы, Доставка за рубеж, Склады и хранение, Грузоперевозки и переезды. Безопасность: Установка сигнализации, Видеонаблюдение, Охрана объектов, Контроль доступа. Работа и карьера: Вакансии и трудоустройство, HR и подбор персонала, Аутсорсинг сотрудников, Карьера и резюме. Искусство и хобби: Музыкальные студии, Танцевальные школы, Изостудии и мастер-классы, Хобби и рукоделие. Коммуникации и медиа: SMM и продвижение, Копирайтинг и тексты, PR и реклама, Блогинг и YouTube, Монтаж и дизайн.'],
                    ['role' => 'user', 'content' => "Определи только подкатегорию для: $title"]
                ],
            ]);

            $json = $response->json();
            Log::info('GPT raw response: ' . json_encode($json));

            if (!isset($json['choices'][0]['message']['content'])) {
                Log::error('GPT response missing expected content. Full response: ' . json_encode($json));
                return [null, null, null];
            }

            $subCategoryName = trim($json['choices'][0]['message']['content']);
            if (str_contains($subCategoryName, ':')) {
                $parts = explode(':', $subCategoryName, 2);
                $subCategoryName = trim($parts[1]); // оставить только подкатегорию
            }

            Log::info('GPT detected subcategory name: ' . $subCategoryName);

            $match = Subcategory::whereRaw('LOWER(TRIM(title)) = ?', [mb_strtolower(trim($subCategoryName))])->first();
            Log::info('Matched subcategory from DB: ' . json_encode($match));

            Log::info('Matched subcategory from DB: ' . json_encode($match?->title));

            return $match ? [$match->category_id, $match->category_sub_id, $subCategoryName] : [null, null, $subCategoryName];

        } catch (\Throwable $e) {
            Log::error('Error during category detection: ' . $e->getMessage());
            return [null, null, null];
        }
    }

    private function extractYouTubeID($url)
    {
        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $url, $matches);
        return $matches[1] ?? null;
    }

    protected function processAllFotos($allFotos, $user, $eventId)
    {
        Log::info('🔁 processAllFotos запущен', [
            'user_id' => $user->id,
            'event_id' => $eventId,
            'files_count' => $allFotos ? count($allFotos) : 0
        ]);

        if ($allFotos) {
            foreach ($allFotos as $foto) {
                $originalName = $foto->getClientOriginalName();
                $uniqueFilename = $user->id . '_' . time() . '_' . $originalName;
                $path = public_path('files/' . $user->id . '/' . $eventId);

                Log::info('📁 Обработка изображения', ['filename' => $originalName, 'save_as' => $uniqueFilename]);

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                    Log::info('📂 Создана папка', ['path' => $path]);
                }

                try {
                    Image::make($foto)
                        ->resize(1200, 1200, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })

                        ->save($path . '/' . $uniqueFilename);

                    Log::info('✅ Изображение сохранено', ['full_path' => $path . '/' . $uniqueFilename]);

                    PortfolioFoto::create([
                        'event_id' => $eventId,
                        'title' => $uniqueFilename,
                    ]);

                    Log::info('💾 Запись в базу добавлена', ['event_id' => $eventId, 'title' => $uniqueFilename]);
                } catch (\Exception $e) {
                    Log::error('❌ Ошибка при обработке изображения', [
                        'filename' => $originalName,
                        'error' => $e->getMessage()
                    ]);
                }
            }
        }
    }


    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return abort(404);
        }
        return view('admin.events.show', compact('event',));
    }

    public function edit($id)
    {

        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $event = Event::findOrFail($id);


        $qrOptions = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
        ]);

        $qrcode = new QRCode($qrOptions);
        $qrCodeData = $qrcode->render('/' . $event->id);


        $lessonTitles = Lesson::where('events_id', $event->id)
            ->where('lesson_chapter', 0)
            ->pluck('title');

        $nearestDate = PortfolioFoto::where('event_id', $id)
            ->whereDate('created_at', '<=', now()->toDateString())
            ->orderByDesc('created_at')
            ->value('created_at');

        if ($nearestDate !== null) {
            $nearestDateFiles = PortfolioFoto::where('event_id', $id)
                ->whereDate('created_at', $nearestDate->toDateString())
                ->pluck('title')
                ->toArray();
        } else {
            $nearestDateFiles = [];
        }

        $latestFotosString = implode(', ', $nearestDateFiles);
        $latestFotos = PortfolioFoto::where('event_id', $id)->get();

        $lessonType = LessonType::where('events_id', $event->id)
            ->orderBy('updated_at', 'desc')
            ->first();

        $addFields = json_decode($event->add_fields, true) ?? [];



        //return view('admin.events.edit', compact('admins','lessonType', 'lessonTitles', 'event', 'currentAdmin', 'qrCodeData',  'latestFotosString'));
        return view('admin.events.edit', compact(
            'admins','lessonType', 'addFields', 'lessonTitles', 'event',
            'currentAdmin', 'qrCodeData', 'latestFotosString', 'latestFotos'
        ));


    }

    public function redactLessonUpdate($id)
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $event = Event::findOrFail($id);
        $lesson = 0;

        redirect()->route('admin.events.redactLesson', compact('id','lesson'));
    }

    public function redactLesson($id,$lesson)
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $event = Event::findOrFail($id);

        return view('admin.events.redactLesson', compact('admins','lesson', 'event', 'currentAdmin'));
    }

    public function update(Request $request, $id)
    {

        $currentAdmin = auth()->user();
        $event = Event::findOrFail($id);
        if ($request->has('description')) {
            $event->description = $request->input('description');
        }




        $request->input('block_4');
        $request->input('block_4_4');
        $request->input('block_5');
        $request->input('block_5_5');
        $request->input('block_6');
        $request->input('block_6_6');
        $request->input('block_7');
        $request->input('block_7_7');
        $request->input('block_8');
        $request->input('block_8_8');
        $request->input('block_9');
        $request->input('block_9_9');
        $request->input('block_10');
        $request->input('block_10_10');
        $request->input('block_11');
        $request->input('block_11_11');
        $request->input('block_12');
        $request->input('block_12-12');
        $request->input('block_13');
        $request->input('block_13_13');


        $fields = [];
        for ($i = 4; $i <= 13; $i++) {
            // Простое поле
            $val = $request->input("block_$i");
            if (!is_null($val)) {
                $fields[] = ['key' => $i, 'value' => $val];
            }

            // Поле с "вариантом"
            $val_variant = $request->input("block_{$i}_{$i}");
            if (!is_null($val_variant)) {
                $fields[] = ['key' => $i, 'value' => $val_variant, 'variant' => $i];
            }

            // Особый случай: block_12-12
            if ($i === 12) {
                $val_dash = $request->input("block_12-12");
                if (!is_null($val_dash)) {
                    $fields[] = ['key' => 12, 'value' => $val_dash, 'variant' => 12];
                }
            }
        }

// Теперь ты можешь сделать json_encode, если нужно
        $json = json_encode($fields, JSON_UNESCAPED_UNICODE);

//dd($json);

        $event->amount = $request->input('amount');
        $event->currency = $request->input('currency');
        $event->location = $request->input('location');
        $event->type_pay = $request->input('type_pay');
        $event->online = $request->input('online');
        $event->discounte = $request->input('discount');
        $event->piple = $request->input('piple');


        $event->save();

        $lessonType = new LessonType();
        $lessonType->events_id = $id;
        $lessonType->type = 1;
        $lessonType->customCheckbox1 = isset($request->customCheckbox1) ? 1 : 0;
        $lessonType->customCheckbox2 = isset($request->customCheckbox2) ? 1 : 0;
        $lessonType->timeFrom1Group1 = $request->input('timeFrom1Group1');
        $lessonType->timeTo1Group1 = $request->input('timeTo1Group1');
        $lessonType->discount1 = $request->input('discount1');

        $lessonType->timeFrom1Group2 = $request->input('timeFrom1Group2');
        $lessonType->timeTo1Group2 = $request->input('timeTo1Group2');
        $lessonType->discount2 = $request->input('discount2');

        $lessonType->timeFrom22Group22 = $request->input('timeFrom22Group22');
        $lessonType->timeTo22Group22 = $request->input('timeTo22Group22');
        $lessonType->discount3 = $request->input('discount3');

        $lessonType->timeFrom33Group33 = $request->input('timeFrom33Group33');
        $lessonType->timeTo33Group33 = $request->input('timeTo33Group33');
        $lessonType->discount4 = $request->input('discount4');
        $lessonType->save();


        if ($request->has('deleteImages')) {
            $imagesToDelete = $request->input('deleteImages');

            PortfolioFoto::whereIn('title', $imagesToDelete)->delete();
        }

        $allFotos = $request->file('allfoto');
        if ($allFotos) {
            foreach ($allFotos as $foto) {
                $uniqueFilename = $currentAdmin->id . '_' . time() . '_' . $foto->getClientOriginalName();
                $path = public_path('files/' . $currentAdmin->id . '/' . $id);

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                // Обрезаем под размер 437x715
                \Intervention\Image\Facades\Image::make($foto)
                    ->fit(1200, 1200)
                    ->save($path . '/' . $uniqueFilename);

                \App\Models\PortfolioFoto::create([
                    'event_id' => $id,
                    'title' => $uniqueFilename,
                ]);
            }
        }


        return redirect()->route('admin.events.edit', ['event' => $event->id])->with('success', 'Событие успешно обновлено');
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

