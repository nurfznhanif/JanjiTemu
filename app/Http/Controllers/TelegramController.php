<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class TelegramController extends Controller
{
    public function handleWebhook(Request $request)
{
    $update = json_decode($request->getContent(), true); // Pastikan untuk decode sebagai array

    if (isset($update['message'])) {
        $chatId = $update['message']['chat']['id'];
        $text = $update['message']['text'];

        // Asumsikan '/start' adalah perintah untuk memulai dan menyimpan chat_id
        if ($text === '/start') {
            $dosen = Dosen::where('telegram_user_id', $chatId)->first();
            if (!$dosen) {
                // Buat record baru atau update existing
                Dosen::create([
                    'telegram_user_id' => $chatId,
                    // Tambahkan kolom lain sesuai kebutuhan
                ]);
            }
        }
    }

    return response()->json(['status' => 'success']);
}
}
