<?php
// Check if the message starts with specific commands for the calculator
if (strpos($message, "/calculate") === 0 || strpos($message, "!calculate") === 0 || strpos($message, ".calculate") === 0) {

    // Extract the calculation query from the message
    // Assuming the message format is "/calculate 2+2"
    $calculationQuery = trim(substr($message, strpos($message, ' ') + 1));

    // Validate and sanitize the input to allow only numbers and arithmetic operators
    $calculationQuery = preg_replace('/[^0-9+\-*\/\(\) .]/', '', $calculationQuery);

    // Prepare the response message
    $responseMessage = "";

    // Evaluate the arithmetic expression
    try {
        // Evaluate the sanitized arithmetic expression
        $result = eval('return ' . $calculationQuery . ';');

        // Prepare the success message
        $responseMessage = "<b>Calculation Result:</b>\n" .
                           "<code>" . htmlspecialchars($calculationQuery) . " = " . $result . "</code>";
    } catch (ParseError $e) {
        // Prepare the error message
        $responseMessage = "There was an error processing your calculation. Please check your input.";
    }

    // Send the message with the calculation result
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => $responseMessage,
        'parse_mode' => 'html',
        'reply_to_message_id' => $message_id
    ]);
}
?>
