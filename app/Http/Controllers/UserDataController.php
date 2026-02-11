<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; // ← ВОТ ЭТОГО НЕ ХВАТАЛО
use App\Models\User;


// Импорт модели User

class UserDataController extends Controller
{

    public function getUserActionStatus()
    {
        $user = Auth::user();

        return response()->json([
            'actions' => $user?->actions
        ]);
    }

    /**
     * Установка actions = 1 для текущего пользователя
     */
    public function setUserAction(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $user->actions = 1;
        $user->save();

        Log::info('User action updated', [
            'user_id' => $user->id,
            'actions' => 1
        ]);

        return response()->json([
            'success' => true
        ]);
    }


    /**
     * Обработка запроса на удаление данных пользователя.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteUserData(Request $request)
    {
        // Проверка подписи запроса для удостоверения его подлинности
        $isValidRequest = $this->isValidRequestSignature($request);

        if (!$isValidRequest) {
            // Если подпись запроса недействительна, вернем ошибку
            Log::error('Invalid signature in delete user data request.');
            abort(400, 'Invalid request signature.');
        }

        // Извлечение идентификатора пользователя из запроса
        $userId = $request->input('user_id');

        // Выполнение удаления данных пользователя по его идентификатору
        $deleted = $this->deleteUserDataById($userId);

        if ($deleted) {
            // Успешное удаление данных
            return response()->json(['message' => 'User data successfully deleted.']);
        } else {
            // Обработка ошибки при удалении данных
            Log::error('Failed to delete user data.');
            abort(500, 'Failed to delete user data.');
        }
    }

    /**
     * Проверка подписи запроса для удостоверения его подлинности.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    private function isValidRequestSignature(Request $request)
    {
        // Реализуйте логику для проверки подписи запроса, чтобы удостовериться в его подлинности.
        // Верните true, если подпись действительна, и false в противном случае.
        // Пример проверки подписи:
        // $signature = $request->header('X-Hub-Signature');
        // $payload = $request->getContent();
        // $secret = env('WEBHOOK_SECRET');
        // return hash_equals('sha256=' . hash_hmac('sha256', $payload, $secret), $signature);
        return true; // Заглушка, необходимо заменить на реальную логику проверки подписи
    }

    /**
     * Удаление данных пользователя по его идентификатору.
     *
     * @param int $userId
     * @return bool
     */
    private function deleteUserDataById($userId)
    {
        // Реализуйте логику для удаления данных пользователя из вашей системы по его идентификатору.
        // Верните true, если удаление прошло успешно, и false в противном случае.
        // Пример удаления данных:
        // $user = User::find($userId);
        // if ($user) {
        //     $user->delete();
        //     return true;
        // }
        // return false;
        return true; // Заглушка, необходимо заменить на реальную логику удаления данных
    }
}
