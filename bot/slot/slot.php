<?php

$filename = 'botty/bot/slot/user.txt';

// Function to get the user's current credits
function getUserCredits($userId) {
    global $filename;
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($id, $credits) = explode(',', $line);
            if ($id == $userId) {
                return (int)$credits;
            }
        }
    }
    return false; // User not found
}

// Function to update the user's credits
function updateUserCredits($userId, $newCredits) {
    global $filename;
    $fileContents = file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    $updatedContents = [];
    $userFound = false;
    
    foreach ($fileContents as $line) {
        list($id, $credits) = explode(',', $line);
        if ($id == $userId) {
            $line = $id . ',' . $newCredits;
            $userFound = true;
        }
        $updatedContents[] = $line;
    }
    
    if (!$userFound) {
        $updatedContents[] = $userId . ',' . $newCredits;
    }
    
    file_put_contents($filename, implode("\n", $updatedContents));
}

// Your slot game logic
if (strpos($message, "/slot") === 0 || strpos($message, "!slot") === 0 || strpos($message, ".slot") === 0) {
    $user_id = // ... obtain the user ID from the message context
    $userCredits = getUserCredits($user_id);

    if ($userCredits === false) {
        $resultText = "Please register for using the slots.";
    } elseif ($userCredits <= 0) {
        $resultText = "You don't have enough credits to play the slot machine.";
    } else {
        $userCredits--; // Deduct 1 credit for playing
        $userGuess = trim(substr($message, strlen("/slot")));
        $guessNumbers = explode(' ', $userGuess);
        $guessNumbers = array_filter($guessNumbers, 'is_numeric'); // Filter out any non-numeric values

        if (empty($userGuess) || count($guessNumbers) != 3) {
            $resultText = "Put a number that is 3 digits long and different than 0";
        } else {
            $number1 = rand(1, 9);
            $number2 = rand(1, 9);
            $number3 = rand(1, 9);
            $slotNumbers = [$number1, $number2, $number3];
            $correctGuesses = count(array_intersect($guessNumbers, $slotNumbers));

            if ($correctGuesses == 3) {
                $resultText = "Congratulations! You guessed all numbers correctly!";
                $userCredits += 5000; // Win 5000 coins for guessing all numbers
            } elseif ($correctGuesses == 2) {
                $resultText = "Well done! You guessed 2 numbers correctly!";
                $userCredits += 3; // Win 3 coins for guessing 2 numbers
            } else {
                $resultText = "Unlucky! Your guesses weren't right, try again!";
            }

            updateUserCredits($user_id, $userCredits);
        }
    }

    // Replace bot() with your actual function to send messages
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => isset($number1) ? "Slot Machine Results:\n\n$number1 | $number2 | $number3\n\nYour guess: $userGuess\n\n$resultText\n\nCredits left: $userCredits" : $resultText,
        'parse_mode' => 'html',
        'reply_to_message_id' => $message_id
    ]);
}

// Replace this placeholder function with your actual bot messaging function
function bot($method, $data) {
    // Your code to send a message to the user
}

?>

