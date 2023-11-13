<?php

if (strpos($message, "/slot") === 0 || strpos($message, "!slot") === 0 || strpos($message, ".slot") === 0) {
    // Extract the user's guess from the message
    $userGuess = substr($message, strlen("/slot"));

    // Check if the user's guess is empty or does not contain valid numbers
    if (empty($userGuess) || !preg_match('/^[1-9\s]+$/', $userGuess)) {
        $resultText = "Put a number that is 3 digit long and different than 0";
    } else {
        // Generate three random numbers between 1 and 9
        $number1 = rand(1, 9);
        $number2 = rand(1, 9);
        $number3 = rand(1, 9);

        // Check if the user's guess matches the generated numbers
        if ($userGuess == "$number1 $number2 $number3") {
            $resultText = "Congratulations! You guessed the numbers correctly! dawg man tag me instant you won premium $user";
        } else {
            $resultText = "Unlucky your guesses werent right my man $user 🫠";
        }
    }

    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "Slot Machine Results:\n\n$number1 | $number2 | $number3\n\n$userGuess\n\n$resultText",
        'parse_mode' => 'html',
        'reply_to_message_id' => $message_id
    ]);
}

?>
