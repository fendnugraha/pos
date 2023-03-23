<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transact_model extends CI_Model
{
    public function sendMessage()
    {
        $this->load->database();

        // token bot Telegram
        $token = '6013173081:AAE9nTCOE75rIXtFsKA3_gZyEJIvkK-gQ58';

        // method untuk mengirim pesan
        $method = 'sendMessage';

        // parameter untuk mengirim pesan
        $params = [
            'chat_id' => '862113568',
            'text' => 's'
        ];

        // URL API Telegram
        $url = 'https://api.telegram.org/bot' . $token . '/' . $method;

        // kirim permintaan ke API Telegram
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        // tampilkan hasil permintaan
        echo $result;
    }
}
