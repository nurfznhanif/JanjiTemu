<?php

namespace App\Http\Controllers;

use Telegram\Bot\Api;
use App\Models\Dosen;

class TelegramNotificationController extends Controller
{
    public function sendNotification($dosenId, $appointmentDetails)
    {
        $dosen = Dosen::findOrFail($dosenId);
        $telegramUserId = $dosen->telegram_user_id; // Pastikan kamu menyimpan ID Telegram user

        $telegram = new Api(env('8192810849:AAELbQBnI66ZHOGinIP5t_M0r_KPM-Kd6JQ'));
        $text = "Ada janji temu baru: " . $appointmentDetails;

        $telegram->sendMessage([
            'chat_id' => $telegramUserId,
            'text' => $text
        ]);

        return response()->json(['message' => 'Notifikasi berhasil dikirim!']);
    }
}

