<?php

$randomNumber = rand(1, 100);

if (strpos($message, "/gay") === 0 || strpos($message, "!gay") === 0 || strpos($message, ".gay") === 0) {
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "You are " . $randomNumber . "% gay $user 😶",
        'parse_mode' => 'html',
        'reply_to_message_id' => $message_id
    ]);
}

// Output the random number
echo $randomNumber;
?>
