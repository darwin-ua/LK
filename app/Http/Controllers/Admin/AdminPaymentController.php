<?php
namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Models\Shedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;



class AdminPaymentController extends Controller
{

    public function index()
    {
        $currentAdmin = auth()->user();

        // Получаем администраторов с определенными ролями
        $admins = User::whereIn('role_id', [1, 2, 3])->get();

        // Выбираем платежи только для текущего авторизованного пользователя
        $payments = Payment::where('account_id', $currentAdmin->id)->get();

        return view('admin.payments.index', compact('admins', 'currentAdmin', 'payments'));
    }


    public function store(Request $request)
    {
        // Генерируем случайный код (буквы + цифры, 6-12 символов)
        $code = Str::upper(Str::random(rand(6, 12)));

        // Приводим данные к нужному формату
        $data = [
            'code' => $code,
            'num_pay_card' => str_replace(' ', '', $request->num_pay_card),
            'summ' => (float) str_replace(',', '.', $request->summ),
            'record_datetime' => $request->record_datetime,
            'account_id' => auth()->id(),
            'status' => 1,
        ];



        // Записываем в базу
        $payment = Payment::create($data);

        return redirect()->route('admin.payments.index')->with('success', 'Платеж успешно добавлен!');
    }

    public function create()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        return view('admin.payments.create',compact('currentAdmin','admins'));
    }

}

