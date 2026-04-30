<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ApiUserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $rawJson = $request->getContent();

            Log::info('ApiUser import request received', [
                'ip' => $request->ip(),
                'size' => strlen($rawJson),
            ]);

            // Убираем неразрывные пробелы, zero-width символы и BOM
            $cleanText = preg_replace('/[\x{00A0}\x{200B}\x{FEFF}]/u', ' ', $rawJson);

            // Если phone пришёл как число с пробелами — приводим к строке
            $cleanText = preg_replace('/"phone"\s*:\s*([\d\s]+)/u', '"phone":"$1"', $cleanText);

            $decoded = json_decode($cleanText, true);

            // Если внутри пришла JSON-строка — декодируем второй раз
            if (is_array($decoded) && isset($decoded[0]) && is_string($decoded[0])) {
                $decoded = json_decode($decoded[0], true);
            }

            if (!is_array($decoded) || !isset($decoded[0]) || !is_array($decoded[0])) {
                return response()->json([
                    'error' => 'Некоректний формат JSON',
                ], 422);
            }

            // Ограничение, чтобы случайно не положить сервер огромным импортом
            if (count($decoded) > 1000) {
                return response()->json([
                    'error' => 'Забагато користувачів в одному запиті',
                ], 422);
            }

            $createdUsers = [];
            $errors = [];

            foreach ($decoded as $index => $item) {
                try {
                    $validated = validator($item, [
                        'id_lk' => ['nullable', 'string', 'max:50'],
                        'name' => ['required', 'string', 'max:255'],
                        'group' => ['nullable', 'string', 'max:50'],
                        'email' => ['nullable', 'email', 'max:255'],
                        'phone' => ['nullable', 'string', 'max:50'],
                        'code_part' => ['nullable', 'string', 'max:100'],
                        'usertype' => ['nullable', 'string', 'max:255'],
                    ])->validate();

                    $email = $validated['email'] ?? null;

                    // no@email.com нельзя использовать для всех — будут дубли и проблемы.
                    if (!$email) {
                        $email = 'user_' . Str::uuid() . '@no-email.local';
                    }

                    // role_id НЕ принимаем из внешнего JSON.
                    // Все импортированные пользователи — обычные дилеры/клиенты.
                    $roleId = 2;

                    $user = User::create([
                        'role_id' => $roleId,
                        'id_lk' => (string)($validated['id_lk'] ?? '0'),
                        'name' => $validated['name'],
                        'group' => (string)($validated['group'] ?? '1'),
                        'email' => $email,
                        'phone' => preg_replace('/\s+/', '', $validated['phone'] ?? ''),
                        'code_part' => $validated['code_part'] ?? null,
                        // Пароль извне НЕ принимаем. Ставим случайный.
                        'password' => Hash::make(Str::random(40)),
                        'usertype' => ($validated['usertype'] ?? '') === 'Дилери:Дарвін' ? 2 : 1,
                    ]);

                    $createdUsers[] = [
                        'id' => $user->id,
                        'id_lk' => $user->id_lk,
                        'email' => $user->email,
                    ];

                    Log::info('ApiUser created', [
                        'id' => $user->id,
                        'id_lk' => $user->id_lk,
                    ]);

                } catch (ValidationException $e) {
                    $errors[] = [
                        'index' => $index,
                        'error' => 'validation',
                        'details' => $e->errors(),
                    ];

                    Log::warning('ApiUser validation error', [
                        'index' => $index,
                        'errors' => $e->errors(),
                    ]);

                } catch (QueryException $e) {
                    $errors[] = [
                        'index' => $index,
                        'error' => 'database',
                    ];

                    Log::error('ApiUser database error', [
                        'index' => $index,
                        'message' => $e->getMessage(),
                    ]);

                } catch (\Throwable $e) {
                    $errors[] = [
                        'index' => $index,
                        'error' => 'unknown',
                    ];

                    Log::error('ApiUser import item error', [
                        'index' => $index,
                        'message' => $e->getMessage(),
                    ]);
                }
            }

            return response()->json([
                'message' => 'Імпорт користувачів завершено',
                'created_count' => count($createdUsers),
                'error_count' => count($errors),
                'users' => $createdUsers,
                'errors' => $errors,
            ], count($errors) ? 207 : 200);

        } catch (\Throwable $e) {
            Log::error('ApiUser import parse error', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => 'Помилка парсингу',
            ], 500);
        }
    }
}
