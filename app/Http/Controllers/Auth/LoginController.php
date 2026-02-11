<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Doing;
use App\Models\Like;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {

        // Выполняем middleware для установки локали перед AuthenticateUsers
        $this->middleware(function ($request, $next) {
            $locale = session('locale', config('app.locale'));
            App::setLocale($locale);
            return $next($request);
        });

        // Применяем middleware AuthenticateUsers
        $this->middleware('guest')->except('logout');
    }


    public function showLoginForm(Request $request)
    {

        $theme = $request->get('theme', 'darwin');

        // 🔴 ВАЖНО: сохраняем тему в сессию
        session(['theme' => $theme]);
        // Получаем тему из GET-параметра. Пример: ?theme=goodwin
        $theme = $request->get('theme', 'darwin'); // по умолчанию darwin

        // Устанавливаем пути к логотипам и картинкам
        $logo = $theme === 'goodwin'
            ? "themes/goodwin/images/goodwin_210.png"
            : "images/Darwin-Logo.svg";


        $partnerLogo = $theme === 'goodwin'
            ? "themes/goodwin/images/veka_280.png"
            : "images/rehau.png";

        // Слайды
        $slides = [
            "themes/$theme/images/slide1.jpg",
            "themes/$theme/images/slide2.jpg",
            "themes/$theme/images/slide3.jpg",
        ];

        if ($theme === 'goodwin') {

            $slideTexts = [
                [
                    'title' => 'GOODWIN — Завод світлопрозорих конструкцій',
                    'text'  => 'Інноваційні рішення для професіоналів. Якісні віконні системи, двері та алюмінієві конструкції. Працюємо з 2010 року.'
                ],
                [
                    'title' => 'Зростай разом з GOODWIN',
                    'text'  => 'Сучасне виробництво, гарантована якість та індивідуальний підхід до кожного клієнта. Розвивай свій бізнес з надійним партнером.'
                ],
                [
                    'title' => 'GOODWIN — стабільність та довіра',
                    'text'  => 'Швидка логістика, технічна підтримка та прозора співпраця. Обирай якість — обирай GOODWIN для своїх проєктів.'
                ],
            ];

        } else {

            $slideTexts = [
                [
                    'title' => 'Працюй з кращими — працюй з DARWIN',
                    'text'  => 'Отримуй якісний продукт, технічну підтримку та прозору співпрацю. Розширюй горизонти свого бізнесу вже сьогодні.'
                ],
                [
                    'title' => 'З DARWIN твій бізнес надійно зростає',
                    'text'  => 'Сучасні рішення для професіоналів ринку вікон та дверей. Працюй ефективно. Розвивайся впевнено. Заробляй більше.'
                ],
                [
                    'title' => 'DARWIN — твій стабільний партнер у кожному проєкті',
                    'text'  => 'Гарантована якість, швидка логістика та підтримка на кожному етапі. Обирай розвиток — обирай DARWIN.'
                ],
            ];
        }

        $pageTitle = $theme === 'goodwin'
            ? 'GOODWIN — Вхід до кабінету дилера'
            : 'DARWIN — Вхід до кабінету дилера';



        return view('auth.login', compact(
            'theme', 'logo', 'partnerLogo', 'slides', 'slideTexts', 'pageTitle'
        ));

    }


    protected function username()
    {
        return 'id_lk'; // Используем поле 'id_lk' вместо 'email'
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'id_lk' => 'required|string', // Поле 'id_lk' обязательно
            'password' => 'required|string', // Пароль обязателен
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            ['id_lk' => $request->input('id_lk'), 'password' => $request->input('password')],
            $request->filled('remember')
        );
    }

    public function logout(Request $request)
    {
        // Получаем тему
        $theme = $request->query('theme', $request->input('theme', 'darwin'));

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/login?theme={$theme}");
    }



    protected function redirectTo()
    {
        // Берем тему, сохраненную в момент логина или в middleware
        $theme = session('theme', 'darwin');

        // Перенаправляем на /admin?theme=...
        return '/cabinet/profile?theme=' . $theme;
    }





}
