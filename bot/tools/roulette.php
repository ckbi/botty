<?php

// ... (previous code for user credits and bot function)

if(strpos($message, "/roulette") === 0 || strpos($message, "!roulette") === 0 || strpos($message, ".roulette") === 0){
    $user_id = // ... obtain the user ID from the message context
    $userCredits = getUserCredits($user_id);

    if ($userCredits === false) {
        $resultText = "Please register to use the roulette.";
    } elseif ($userCredits < 2) {
        $resultText = "You need at least 2 credits to play roulette.";
    } else {
        $userCredits -= 2; // Deduct 2 credits for playing
        $userGuess = trim(substr($message, strlen("/roulette")));
        $rouletteNumber = rand(0, 36);
        $rouletteColor = ($rouletteNumber == 0) ? 'green' :
                         (($rouletteNumber >= 1 && $rouletteNumber <= 10) || ($rouletteNumber >= 19 && $rouletteNumber <= 28)) ?
                         (($rouletteNumber % 2 == 0) ? 'black' : 'red') :
                         (($rouletteNumber % 2 == 0) ? 'red' : 'black');
        $rouletteParity = ($rouletteNumber % 2 == 0) ? 'pair' : 'unpair';

        if ($userGuess == $rouletteNumber || strtolower($userGuess) == $rouletteColor || strtolower($userGuess) == $rouletteParity) {
            $resultText = "Congratulations! Your guess was correct!";
            $userCredits += 4; // Win 2 coins (net gain of 2 since 2 were deducted)
        } else {
            $resultText = "Unlucky! Your guess was not correct.";
        }

        updateUserCredits($user_id, $userCredits);

        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "Roulette Results:\n\nNumber: $rouletteNumber\nColor: $rouletteColor\nParity: $rouletteParity\n\nYour guess: $userGuess\n\n$resultText\n\nCredits left: $userCredits",
            'parse_mode' => 'html',
            'reply_to_message_id' => $message_id
        ]);
    }
}

// ... (rest of your code)

?>
