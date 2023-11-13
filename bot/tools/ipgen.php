<?php
if (strpos($message, "/ip") === 0 || strpos($message, "!ip") === 0 || strpos($message, ".ip") === 0) {
    // Start the timer
    $startTime = microtime(true);

    // Extract the number of IP addresses to generate from the message
    $ipCount = intval(substr($message, 4));

    // If no count is provided or the count is less than 1, set it to 1
    if ($ipCount < 1) {
        $ipCount = 1;
    }

    // Generate the IP addresses
    $ipAddresses = generateIPAddresses($ipCount);

    // If the count is greater than 10, save the IP addresses in a temporary text file
    if ($ipCount > 10) {
        $filePath = saveIPAddressesToFile($ipAddresses);

        // Send the text file as a document
        bot('senddocument', [
            'chat_id' => $chat_id,
            'document' => new CURLFile($filePath),
            'reply_to_message_id' => $message_id
        ]);

        // Delete the temporary text file
        unlink($filePath);
    } else {
        // Send the IP addresses as a message
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => implode("\n", $ipAddresses),
            'parse_mode' => 'html',
            'reply_to_message_id' => $message_id
        ]);
    }

    // Calculate the time taken
    $endTime = microtime(true);
    $timeTaken = round(($endTime - $startTime), 2); // in seconds

    // Send the number of IPs generated and the time taken as a message
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => "Generated " . $ipCount . " IP addresses in " . $timeTaken . " seconds.",
        'parse_mode' => 'html',
        'reply_to_message_id' => $message_id
    ]);
}

// Function to generate the specified number of IP addresses
function generateIPAddresses($count) {
    $ipAddresses = array();

    for ($i = 0; $i < $count; $i++) {
        $ipAddress = rand(1, 255) . "." . rand(0, 255) . "." . rand(0, 255) . "." . rand(0, 255);
        $ipAddresses[] = $ipAddress;
    }

    return $ipAddresses;
}

// Function to save the IP addresses in a temporary text file
function saveIPAddressesToFile($ipAddresses) {
    $filePath = tempnam(sys_get_temp_dir(), 'ips');
    $file = fopen($filePath, "w");

    foreach ($ipAddresses as $ipAddress) {
        fwrite($file, $ipAddress . "\n");
    }

    fclose($file);

    return $filePath;
}
?>
