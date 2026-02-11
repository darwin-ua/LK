<?php


namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.cabinet.profile.index', [
            'theme' => session('theme', 'darwin'),
            'defaultPage' => 'profile',
            'user' => Auth::user(),
        ]);
    }

    // 🔼 ЗАГРУЗКА АВАТАРА
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        // удалить старый файл
        if ($user->avatar) {
            $oldPath = public_path($user->avatar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // имя файла
        $fileName = uniqid() . '.' . $request->file('avatar')->getClientOriginalExtension();

        // сохранить файл
        $request->file('avatar')->move(
            public_path('uploads/avatars'),
            $fileName
        );

        // сохранить путь в БД
        $user->avatar = 'uploads/avatars/' . $fileName;
        $user->save();

        return back();
    }

    // ❌ УДАЛЕНИЕ АВАТАРА
    public function deleteAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            $fullPath = public_path($user->avatar);

            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            $user->avatar = null;
            $user->save();
        }

        return back();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Поточний пароль невірний',
            ], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Пароль успішно змінено',
        ]);
    }

    public function updatePersonalInfo(Request $request)
    {
        try {

            // === Ручная валидация (чтобы не было "тихих" 422) ===
            $validator = \Validator::make($request->all(), [
                'first_name'   => 'required|string|max:255',
                'last_name'    => 'required|string|max:255',
                'email'        => 'required|email|max:255',
                'phone'        => 'nullable|string|max:30',
                'adres'        => 'nullable|string|max:255',
                'type_company' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'error'   => 'Validation failed',
                    'details' => $validator->errors(),
                ], 422);
            }

            $validated = $validator->validated();

            // === Авторизация ===
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error'   => 'User not authenticated',
                ], 401);
            }

            // === Обновление данных ===
            $user->name = trim($validated['first_name'] . ' ' . $validated['last_name']);
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] ?? null;
            $user->type_company = $validated['type_company'] ?? null;

            // ⚠️ если колонки нет — здесь будет SQL ошибка, и она уйдёт в catch
            if (array_key_exists('adres', $validated)) {
                $user->adres = $validated['adres'];
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Персональні дані успішно збережені',
            ]);

        } catch (\Throwable $e) {

            // === В DEV возвращаем РЕАЛЬНУЮ ошибку ===
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ], 500);
        }
    }



}
