<?php


namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Shedule;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Event;
use App\Models\Order;
use App\Models\Doing;
use Illuminate\Support\Facades\Log; // Добавлен импорт класса Log
use Illuminate\Support\Facades\Auth;
use App\Models\PortfolioFoto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response; // Если этот импорт отсутствует




class CartController extends Controller
{

    public function cartOpen(Request $request)
    {
        //return redirect()->route('cart.show');
    }

    public function getBusyDates($id)
    {
        // Получаем занятые даты из таблицы Order
        $busyDates= Order::where('order_id', $id)->pluck('order_date')->toArray();

        // Форматируем даты в формат Y-m-d
        $formattedBusyDates = [];
        foreach ($busyDates as $date) {
            try {
                // Подстройте формат даты, если необходимо
                $formattedDate = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('Y-m-d');
                $formattedBusyDates[] = $formattedDate;
            } catch (\Exception $e) {
                continue;
            }
        }

        // Возвращаем массив с занятыми датами в формате JSON
        return Response::json($formattedBusyDates);
    }
    public function showCheckoutForm()
    {
        // Получаем последнюю запись по ID
        $lastOrder = Order::latest('id')->first();

        // Передаем запись в представление
        return view('cart.design', ['lastOrder' => $lastOrder]);
    }

    // CartController.php
    public function getCartContents(Request $request) {

        // Проверка заголовка Referer
        $referer = $request->headers->get('referer');
        $origin = $request->headers->get('origin');

        // Определите URL вашего сайта
        $allowedReferer = config('app.url');

        // Проверяем, что запрос пришел с вашего сайта (Referer или Origin должен быть равен вашему URL)
        if (!$referer || !$origin || !str_contains($referer, $allowedReferer) || !str_contains($origin, $allowedReferer)) {
            return response()->json(['error' => 'Unauthorized request'], 403);
        }
        // Получаем uuid из cookie
        $uuid = $request->cookie('uuid');

        // Если uuid существует, фильтруем товары по uuid
        if ($uuid) {
            // Получаем количество товаров, связанных с данным uuid
            $cartCount = Product::where('uuid', $uuid)->count();
        } else {
            // Если uuid не найден, корзина пуста
            $cartCount = 0;
        }

        // Возвращаем количество товаров в формате JSON
        return response()->json([
            'cartCount' => $cartCount
        ]);
    }

    public function getDoingCartContents(Request $request)
    {
        // Получаем uuid из cookie
        $uuid = $request->cookie('uuid');

        // Если uuid существует, фильтруем события по uuid
        if ($uuid) {
            // Получаем количество событий, связанных с данным uuid
            $cartDoingCount = Doing::where('uuid', $uuid)->count();
        } else {
            $cartDoingCount = 0;
        }

        return response()->json([
            'cartDoingCount' => $cartDoingCount
        ]);
    }

    public function showCart(Request $request)
    {
        $user = Auth::user();
        $uuid = $request->cookie('uuid');

        // Получаем товары из таблицы Product
        $cartItems = Product::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->with([
                'event:id,user_id,category,discounte',
                'event.portfolioFotos' => function ($query) {
                    $query->select('id', 'event_id', 'title');
                }
            ])
            ->get();

        // Обработка фото для товаров
        foreach ($cartItems as $item) {
            if ($item->event) {
                $firstImage = $item->event->portfolioFotos->first();
                if ($firstImage) {
                    $userId = $item->event->user_id ?? 'default';
                    $item->photo = asset('files/' . $userId . '/' . $item->event->id . '/' . $firstImage->title);
                } else {
                    $item->photo = asset('path/to/default/image.jpg'); // Путь к изображению по умолчанию
                }
            } else {
                $item->photo = asset('path/to/default/image.jpg'); // Путь к изображению по умолчанию
            }
        }

        $doingItems = Doing::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->with([
                'event:id,user_id,category,discounte',
                'event.portfolioFotos' => function ($query) {
                    $query->select('id', 'event_id', 'title');
                }
            ])
            ->get();

        foreach ($doingItems as $items) {
            if ($items->event) {
                $event_id = $items->event->id; // Получаем event_id
                $event = Event::find($event_id);
                $event_type_pay = $event ? $event->type_pay : null;

                // Устанавливаем тип оплаты для каждого элемента
                $items->event_type_pay = $event_type_pay;

                // Обработка фото, как и раньше
                $firstImages = $items->event->portfolioFotos->first();
                if ($firstImages) {
                    $userIds = $items->event->user_id ?? 'default';
                    $items->photo = asset('files/' . $userIds . '/' . $items->event->id . '/' . $firstImages->title);
                } else {
                    $items->photo = asset('path/to/default/image.jpg'); // Путь к изображению по умолчанию
                }
            } else {
                $items->photo = asset('path/to/default/image.jpg'); // Путь к изображению по умолчанию
            }
        }

        $formattedBusyDates = [];

        // Проверяем, есть ли товары в корзине
        if ($cartItems->isNotEmpty()) {
            $event_id = $cartItems->first()->event->id ?? null;
            if ($event_id) {
                $busyDates = Order::where('order_id', $event_id)->pluck('order_date')->toArray();

                if (!empty($busyDates)) {
                    foreach ($busyDates as $date) {
                        try {
                            // Предположим, что дата в формате 'd/m/Y'
                            $formattedDate = \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
                            $formattedBusyDates[] = $formattedDate;
                        } catch (\Exception $e) {
                            continue;
                        }
                    }
                }
            }
        }

        // Проверяем, есть ли события
        if ($doingItems->isEmpty() && $cartItems->isEmpty()) {
            return view('cart.empty'); // Возвращаем представление для пустой корзины
        }

        // Получаем количество товаров в корзине для текущей сессии
        $sessionId = session()->getId();
        $cartCount = Product::where('uuid', $uuid)
            ->where('status', 0)
            ->when($user, function ($query) use ($user) {
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

        // Проверяем, если событие найдено
        $event = isset($event_id) ? Event::find($event_id) : null;
        $event_type_pay = $event ? $event->type_pay : null;

        return view('cart.show', compact('cartItems', 'event_type_pay', 'formattedBusyDates', 'doingItems', 'cartCount', 'cartDoingCount', 'likeCount'));
    }


    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
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

        $user = Auth::user();
        // Получаем id продукта из запроса
        $productId = $request->id;
        $sessionId = session()->getId(); // Получаем уникальную сессию пользователя
        $uuid = $request->cookie('uuid'); // Получаем UUID из cookie

        // Ищем событие в таблице Events по event_id
        $event = Event::find($productId);

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found'], 404);
        }

        // Получаем title и amount из события
        $title = $event->title;
        $amount = $event->amount;
        $discounte = $event->discounte;

        // Поиск продукта в корзине по id продукта и уникальной сессии
        $product = Product::where('event_id', $productId)
            ->where('uuid', $uuid)
            ->first();

        // Если продукта нет в корзине для данной сессии, создаем новую запись
        if (!$product) {
            $product = new Product();
            $product->event_id = $productId;
            $product->session_id = $sessionId; // Сохраняем уникальную сессию
            $product->name = $title; // Устанавливаем название продукта из события
            $product->price = $amount; // Устанавливаем цену продукта из события
            $product->user_id = $user ? $user->id : null;
            $product->uuid = $uuid; // Сохраняем UUID
            $product->discounte =  $discounte; // Сохраняем UUID
        } else {
            // Если продукт уже есть в корзине, обновляем его данные
            $product->name = $title;
            $product->price = $amount;
            $product->user_id = $user ? $user->id : null;
        }

        // Сохраняем или обновляем запись в базе данных
        $product->save();

        // Получаем общее количество уникальных товаров в корзине для текущей сессии
        //$cartCount = Product::where('uuid', $uuid)->count();
        $cartCount = Product::where('uuid', $uuid)
            ->when($user, function ($query) use ($user) {
                // Если пользователь авторизован, добавляем товары с его user_id
                $query->orWhere('user_id', $user->id);
            })
            ->count();

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    public function addDoing(Request $request)
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

        $user = Auth::user();
        $eventId = $request->id;
        $sessionId = session()->getId();
        $uuid = $request->cookie('uuid');

        $event = Event::find($eventId);

        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found'], 404);
        }

        $title = $event->title;
        $amount = $event->amount;
        $discounte = $event->discounte;

        $doing = Doing::where('event_id', $eventId)
            ->where('uuid', $uuid)
            ->first();

        if (!$doing) {
            $doing = new Doing();
            $doing->event_id = $eventId;
            $doing->session_id = $sessionId;
            $doing->name = $title;
            $doing->price = $amount;
            $doing->user_id = $user ? $user->id : null;
            $doing->uuid = $uuid;
            $doing->discounte = $discounte;
        } else {
            $doing->name = $title;
            $doing->price = $amount;
            $doing->user_id = $user ? $user->id : null;
        }

        $doing->save();

        $cartCount = Doing::where('uuid', $uuid)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->count();

        return response()->json(['success' => true, 'cartCount' => $cartCount]);
    }

    public function remove(Request $request, $id)
    {
        // Извлекаем UUID из cookie
        $uuid = $request->cookie('uuid');

        // Проверяем, что UUID существует
        if ($uuid) {
            // Ищем запись в таблице Products по UUID и ID события
            $product = \App\Models\Product::where('uuid', $uuid)->where('event_id', $id)->first();

            // Если запись найдена, удаляем её
            if ($product) {
                $product->delete();
            }

            // Ищем запись в таблице Doings по UUID и ID события
            $doing = \App\Models\Doing::where('uuid', $uuid)->where('event_id', $id)->first();

            // Если запись найдена, удаляем её
            if ($doing) {
                $doing->delete();
            }
        }

        // Возвращаем пользователя на страницу заказа
        return redirect()->route('cart.show');

    }

    public function clear(Request $request)
    {
        $request->session()->forget('cart');
        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        $uuid = $request->cookie('uuid');

        $cartItems = Product::where('uuid', $uuid)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
        }

        foreach ($cartItems as $item) {
            $order = new Order();
            $order->name = $request->name;
            $order->first = $request->first;
            $order->email = $request->email;
            $order->user_register = $request->user_register;
            $order->phone = $request->phone;
            $order->order_id = uniqid();
            $order->event_id = $item->event_id;
            $order->user_id = $user ? $user->id : null;
            $order->code = $request->code;
            $order->data_create_order = now();
            $order->order_date = $request->order_date ?? now();
            $order->amount = $item->price;
            $order->status = 'pending';
            $order->save();
        }

        Product::where('uuid', $uuid)
            ->when($user, function ($query) use ($user) {
                $query->orWhere('user_id', $user->id);
            })
            ->delete();

        return response()->json(['success' => true, 'message' => 'Order placed successfully']);
    }

}

