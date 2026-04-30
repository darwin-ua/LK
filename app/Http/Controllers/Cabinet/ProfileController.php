<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\PartnerManager;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $idLk = $user->dealer_id ?? $user->id_lk ?? $user->onec_id ?? null;

        $partnerManager = null;

        if ($idLk) {
            $partnerManager = PartnerManager::where('id_lk', $idLk)->first();
        }

        return view('admin.cabinet.profile.index', [
            'theme' => session('theme', 'darwin'),
            'defaultPage' => 'profile',
            'user' => $user,
            'partnerManager' => $partnerManager,
        ]);
    }

    // 🔼 ЗАГРУЗКА АВАТАРА
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $user = Auth::user();

        if (!$user) {
            abort(401);
        }

        // удалить старый файл
        if ($user->avatar) {
            $oldPath = public_path($user->avatar);

            // защита: удаляем только из uploads/avatars
            $avatarsDir = realpath(public_path('uploads/avatars'));
            $oldRealPath = realpath($oldPath);

            if ($avatarsDir && $oldRealPath && str_starts_with($oldRealPath, $avatarsDir) && file_exists($oldRealPath)) {
                unlink($oldRealPath);
            }
        }

        // имя файла безопасное, без оригинального имени пользователя
        $extension = $request->file('avatar')->extension();
        $fileName = Str::uuid() . '.' . $extension;

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

        if (!$user) {
            abort(401);
        }

        if ($user->avatar) {
            $fullPath = public_path($user->avatar);

            // защита: удаляем только из uploads/avatars
            $avatarsDir = realpath(public_path('uploads/avatars'));
            $realPath = realpath($fullPath);

            if ($avatarsDir && $realPath && str_starts_with($realPath, $avatarsDir) && file_exists($realPath)) {
                unlink($realPath);
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
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Користувач не авторизований',
            ], 401);
        }

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
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'error' => 'Користувач не авторизований',
                ], 401);
            }

            $validated = $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],
                'phone' => ['nullable', 'string', 'max:30'],
                'adres' => ['nullable', 'string', 'max:255'],
                'type_company' => ['nullable', 'string', 'max:255'],
            ]);

            $user->name = trim($validated['first_name'] . ' ' . $validated['last_name']);
            $user->email = $validated['email'];
            $user->phone = $validated['phone'] ?? null;
            $user->type_company = $validated['type_company'] ?? null;

            if (array_key_exists('adres', $validated)) {
                $user->adres = $validated['adres'];
            }

            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Персональні дані успішно збережені',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'details' => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            Log::error('Profile update error', [
                'user_id' => Auth::id(),
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Помилка збереження профілю',
            ], 500);
        }
    }
}
