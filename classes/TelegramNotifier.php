<?php

require_once __DIR__ . '/Notifier.php';

class TelegramNotifier extends Notifier
{
	public function notify($notifierCfg, string $msg)
    {
        $chat_id = $notifierCfg['chat_id'];
        $disable_web_page_preview = true;
        $reply_to_message_id = null;
        $reply_markup = null;

        $data = array(
            'chat_id' => urlencode($chat_id),
            'text' => $msg
        );

        $url = 'https://api.telegram.org/bot' . $notifierCfg['bot_id'] . '/sendMessage';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}
