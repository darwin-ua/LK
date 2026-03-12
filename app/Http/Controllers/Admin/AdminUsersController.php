<?php
namespace App\Http\Controllers\Admin;

use App\Models\Alert;
use App\Models\Event;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserData;

class AdminUsersController extends Controller
{

    public function index()
    {


        $admins = User::where('role_id', 1)->get();
        $users = User::all();
        $currentAdmin = auth()->user();

        // Получаем события с основными данными
        $events = Event::where('user_id', $currentAdmin->id)
            ->get(['id', 'title as title', 'start_date as start', 'end_date as end']);

        return view('admin.users.index', compact('admins','currentAdmin','users','events'));
    }

    public function storeData(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'settings' => 'required|string',
            // Добавьте другие поля, если необходимо
        ]);
        // Сохранение данных
        $userData = new UserData();
        $userData->user_id = $request->user_id; // или другой ID пользователя
        $userData->email = Auth::user()->email; // Пример получения email текущего пользователя
        $userData->settings = $request->settings;
        $userData->save();

        // Перенаправление с сообщением об успехе
        return back()->with('success', 'Данные успешно сохранены.');
    }

    public function statistic()
    {
        $user = Auth::user();
        $currentAdmin = auth()->user();

            $alertCount =  Alert::where('user_id', $user->id)
                ->orderBy('id', 'DESC')
                ->paginate(10000);

        $admins = User::where('role_id', 1)->get();
        // Получаем события с основными данными
        $events = Event::where('user_id', $currentAdmin->id)
            ->get(['id', 'title as title', 'start_date as start', 'end_date as end']);

        return view('admin.users.statistic', compact('admins', 'currentAdmin','alertCount','events'));
    }

    public function updateAlertStatus(Request $request)
    {
        $alert = Alert::find($request->id);

        if ($alert) {
            $alert->status = 1; // Установить "прочитано" (или другое значение)
            $alert->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }


    public function create()
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();
        $users = User::all();

        return view('admin.users.create',compact('admins','currentAdmin','users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'foto_title' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('foto_title')) {
            $fotoTitle = $request->file('foto_title');
            $userId = Auth::id();
            $uniqueFilename = $userId . '_' . time() . '_' . $fotoTitle->getClientOriginalName();
            $fotoTitle->storeAs('public/files/' . $userId, $uniqueFilename);
            $request->merge(['foto_title' => $uniqueFilename]);
        }

        $user = Auth::user();
        if ($user) {
            $user = new User();
            $user->user_id = $user->id;
            $user->fill($request->all());
            $user->save();
            return redirect()->route('admin.users.all')->with('success', 'Event created successfully');
        } else {
            return redirect()->route('login');
        }
    }

    public function redact($id)
    {
        $currentAdmin = auth()->user();
        $admins = User::where('role_id', 1)->get();

        // Получаем записи из users_data для пользователя
        $userDataRecords = UserData::where('user_id', $id)->get();

        return view('admin.users.edit', compact('admins', 'currentAdmin', 'userDataRecords'));
    }


    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return abort(404);
        }
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->title = $request->input('title');
        $user->location = $request->input('location');
        $user->save();

        return redirect()->route('admin.users.edit', ['user' => $user->id])->with('success', 'Событие успешно обновлено');

    }

//    public function destroy(User $user)
//    {
//        if (!$user) {
//            return abort(404);
//        }
//
//        $user->delete();
//
//        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
//    }

    public function destroyUserData($userDataId)
    {
        $userData = UserData::findOrFail($userDataId);
        $userData->delete();

        return back()->with('success', 'Данные пользователя успешно удалены.');
    }


}

