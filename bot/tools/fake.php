<?php

if ($message == '/fake' || $message == '!fake' || $message == '.fake') {
    // Get a fake identity from Random User API
    $apiUrl = 'https://randomuser.me/api/';
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    // Extract the generated identity details
    $name = $data['results'][0]['name']['first'] . ' ' . $data['results'][0]['name']['last'];
    $address = $data['results'][0]['location']['street']['number'] . ' ' . $data['results'][0]['location']['street']['name'] . ', ' . $data['results'][0]['location']['city'] . ', ' . $data['results'][0]['location']['state'] . ', ' . $data['results'][0]['location']['country'];
    $phone = $data['results'][0]['phone'];
    $email = $data['results'][0]['email'];
    $dob = $data['results'][0]['dob']['date'];
    $gender = $data['results'][0]['gender'];
    $education = $data['results'][0]['nat'];
    $avatar = $data['results'][0]['picture']['large'];

    // Format the identity details into a message
    $message = "
Name: <pre>$name</pre>
Address: <pre>$address</pre>
Phone: <pre>$phone</pre>
Email: <pre>$email</pre>
Date of Birth: <pre>$dob</pre>
Gender: <pre>$gender</pre>
Nationality: <pre>$education</pre>";

    // Send the message with the avatar image as a thumbnail using your preferred method (e.g., Telegram bot API)
    bot('sendphoto', [
        'chat_id' => $chat_id,
        'photo' => $avatar,
        'caption' => $message,
        'parse_mode' => 'html',
        'reply_to_message_id' => $message_id,
        'thumb' => $avatar
    ]);
}
?>
