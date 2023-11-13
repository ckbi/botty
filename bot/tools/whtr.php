<?php
if (strpos($message, "/wthr") === 0 || strpos($message, "!wthr") === 0 || strpos($message, ".wthr") === 0) {
    $command_parts = explode(" ", $message);
    if (count($command_parts) >= 2) {
        $city = urlencode(implode(" ", array_slice($command_parts, 1)));
        $weatherData = getWeatherData($city);

        if ($weatherData !== null) {
            $temperature = $weatherData['temperature'];
            $description = $weatherData['description'];

            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "Weather in $city:\nDescription: $description",
                'reply_to_message_id' => $message_id
            ]);
        } else {
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "Failed to fetch weather information for $city",
                'reply_to_message_id' => $message_id
            ]);
        }
    } else {
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "Please provide a city after the /wthr command.",
            'reply_to_message_id' => $message_id
        ]);
    }
}

function getWeatherData($city) {
    $apiKey = '897a852f4511427eab4222238233009';
    $url = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['current'])) {
        $temperature = $data['current']['temp_c'];
        $description = $data['current']['condition']['text'];

        return [
            'temperature' => $temperature,
            'description' => $description
        ];
    } else {
        return null;
    }
}
?>
