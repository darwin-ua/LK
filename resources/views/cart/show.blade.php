@include('cart.filter')

<div class="container margin_60">

    <div class="main_title">
    </div>
    <section class="promo_full">
        <div class="promo_full_wp magnific">
            &nbsp;
        </div>
    </section>

    <div class="container margin_60" style="padding-top: 75px; padding-bottom: 6px;">
        <div class="main_title">
            <h2><span>Замовлення</span></h2>
        </div>
    </div>
    @if($cartItems->isNotEmpty())
        <h3 style="margin-top: -40px;">Товари</h3>
        <div class="container margin_60" style="padding-top: 7px; padding-bottom: 6px;">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фото</th>
                    <th scope="col">Назва</th>
                    <th scope="col">Ціна</th>
                    <th scope="col">Знижка</th>
                    <th scope="col">Кількість</th>
                    <th scope="col">Сума</th>
                    <th scope="col">Дії</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $totalQuantity = 0;
                    $totalPrice = 0;
                @endphp
                @foreach($cartItems as $item)
                    @if($item->event && $item->event->category == 4)
                        <tr data-item-id="{{ $item->id }}" data-price="{{ $item->price }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><img src="{{ $item->photo }}" alt="Фото товара" width="50"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->discounte ?? '-' }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary increase-quantity" style="margin-right: 10px;">+</button>
                                <span class="quantity" style="margin: 0 10px; padding: 2px 8px; border: 1px solid #ccc; border-radius:4px;">0{{ $item->quantity }}</span>
                                <button class="btn btn-sm btn-danger decrease-quantity" style="margin-left: 10px;">-</button>
                            </td>
                            <td id="summa">{{ $item->price * $item->quantity }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item->event->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить товар из корзины?');">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @php
                            $totalQuantity += $item->quantity;
                            $totalPrice += $item->price * $item->quantity;
                        @endphp
                    @endif
                @endforeach
                </tbody>
            </table>
            <hr>
            <tr>
                <td colspan="2" class="text-right"><strong>Загальна сума:</strong> <span id="total-price">{{ $totalPrice }}</span></td>
            </tr>
            <hr>
            <div class="main_title">
                <form action="{{ route('cart.checkout.form') }}" method="GET">
                    @csrf
                    <button type="submit" style="background-color: #ffc107; border-color: #ffc107;" class="btn btn-warning"><span style="color: #ffffff;">Оформлення</span></button>
                </form>
            </div>
        </div>
    @endif
    @if($doingItems->isNotEmpty())
    <h3 style="margin-top: -55px;">Події</h3>
    <div class="container margin_60" style="margin-top: -35px;">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Фото</th>
                <th scope="col">Назва</th>
                <th scope="col">Ціна</th>
                <th scope="col">Знижка</th>
                <th scope="col">Кількість</th>
                <th scope="col"  {{ ($event_type_pay == 1 || $event_type_pay == 2) ? '' : 'hidden' }}>Час</th>
                <th scope="col">Дія</th>
            </tr>
            </thead>
            <tbody>
            @foreach($doingItems as $items)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><img src="{{ $items->photo }}" alt="Фото товара" width="50"></td>
                    <td>{{ $items->name }}</td>
                    <td>{{ $items->price == 0 || is_null($items->price) ? 'FREE' : $items->price }}</td>

                    <td>{{ $items->discount ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary increase-quantity" id="increase-quantity-{{ $items->id }}" style="margin-right: 10px;">+</button>
                        <span class="quantity" id="quantity-{{ $items->id }}" style="margin: 0 10px; padding: 2px 8px; border: 1px solid #ccc; border-radius:4px;">1</span>
                        <button class="btn btn-sm btn-danger decrease-quantity" id="decrease-quantity-{{ $items->id }}" style="margin-left: 10px;">-</button>
                    </td>
                    <td>
                        <form action="{{ route('cart.remove', $items->event->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Удалить товар из корзины?');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form  action="/{{ $items->event_id }}" method="GET">
                        <button type="submit" style="background-color: #ffc107; border-color: #ffc107;" class="btn btn-warning" name="redirect" value="guest">
                            <span style="color: #ffffff;">Записатись</span>
                        </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@include('cart.filter_footer')
