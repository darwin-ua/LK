<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function stream( $videoFileName)
    {
        $videoPath = storage_path('app/public/storage/1/' . $videoFileName);


        $fileSize = Storage::disk('public')->size('files/1/' . $videoFileName);

        $headers = [
            'Content-Type' => 'video/mp4',
        ];

        return response()->stream(function () use ($videoPath) {
            $stream = fopen($videoPath, 'r');
            fpassthru($stream);
            fclose($stream);
        }, 200, $headers);
    }
    public function play($videoId)
    {
        // Ваша логика для получения пути к видео файла по его ID

        // Здесь можно использовать логику для получения пути к видео файлу
       $videoPath = 'app/public/storage/1/19795.mp4';

        // Возвращаем редирект на реальный URL видео файла
        // Или вы можете возвращать сам файл, если это требуется
        return redirect($videoPath);
    }
}
