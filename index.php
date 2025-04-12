<?php

$content = file_get_contents("php://input");
$update = json_decode($content, true);


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Este script está diseñado para recibir actualizaciones POST desde Telegram.";
    exit;
}


if (isset($update["message"])) {
    $message = $update["message"];
    $text = $message["text"] ?? '';
    $chatId = $message["chat"]["id"] ?? null;

    $botToken = "7776030722:AAHUbx6JV6IznfRW7IaqulfixvrKd5cxISo";

    if ($chatId) {
        switch (strtolower($text)) {
            case '/start':
                $response = '¡Buenas! Dime un producto y te diré en qué pasillo está.';
                break;

            case 'carne':
            case 'queso':
            case 'jamón':
                $response = 'Ese producto está en el Pasillo 1.';
                break;

            case 'leche':
            case 'yogurth':
            case 'cereal':
                $response = 'Ese producto está en el Pasillo 2.';
                break;

            case 'bebidas':
            case 'jugos':
                $response = 'Ese producto está en el Pasillo 3.';
                break;

            case 'pan':
            case 'pasteles':
            case 'tortas':
                $response = 'Ese producto está en el Pasillo 4.';
                break;

            case 'detergente':
            case 'lavaloza':
                $response = 'Ese producto está en el Pasillo 5.';
                break;

            default:
                $response = 'Perdón, no entiendo.';
                break;
        }

        sendMessage($chatId, $response, $botToken);
    } else {
        error_log("chat_id no definido");
    }

} else {
    error_log("No se recibió mensaje desde Telegram");
}



function sendMessage($chatId, $message, $botToken) {
    $url = "https://api.telegram.org/bot$botToken/sendMessage";

    $data = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'Markdown'
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context  = stream_context_create($options);
    $result = @file_get_contents($url, false, $context);

if ($result === FALSE) {
    $error = error_get_last();
    error_log("Error al enviar mensaje a Telegram: " . $error['message']);
} else {
    error_log("Telegram respondió: " . $result);
}

}
?>
