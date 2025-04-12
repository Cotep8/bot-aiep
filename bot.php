<?php
$token = '7776030722:AAHUbx6JV6IznfRW7IaqulfixvrKd5cxISog';
$website = "https://api.telegram.org/bot".$token;
$input = file_get_contents(filename: "php://input");
$update = json_decode(json: $input, associative: TRUE);
$chat_id = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

switch($message) {
    case '/start':
        $response = '¡Buenas! Dime un producto y te diré en qué pasillo está.';
        sendMessage(chatId: $chatId, response: $response);
        break;

    case 'carne':
    case 'queso':
    case 'jamón':
        $response = 'Ese producto está en el Pasillo 1.';
        sendMessage(chatId: $chatId, response: $response);
        break;

    case 'leche':
    case 'yogurth':
    case 'cereal':
        $response = 'Ese producto está en el Pasillo 2.';
        sendMessage(chatId: $chatId, response: $response);
        break;

    case 'bebidas':
    case 'jugos':
        $response = 'Ese producto está en el Pasillo 3.';
        sendMessage(chatId: $chatId, response: $response);
        break;

    case 'pan':
    case 'pasteles':
    case 'tortas':
        $response = 'Ese producto está en el Pasillo 4.';
        sendMessage(chatId: $chatId, response: $response);
        break;

    case 'detergente':
    case 'lavaloza':
        $response = 'Ese producto está en el Pasillo 5.';
        sendMessage(chatId: $chatId, response: $response);
        break;

    default:
        $response = 'Perdón, no entiendo la pregunta.';
        sendMessage(chatId: $chatId, response: $response);
        break;
}

function sendMessage($chatId, $response): void {
    global $website;
    file_get_contents(filename: $website . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode(string: $response) . "&parse_mode=Markdown");
}
?>