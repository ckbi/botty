<?php
if (strpos($message, "/quote") === 0 || strpos($message, "!quote") === 0 || strpos($message, ".quote") === 0) {
    // Fetch a random quote from the Quotable API
    $quoteUrl = "https://api.quotable.io/random";
    $quoteResponse = file_get_contents($quoteUrl);
    $quoteData = json_decode($quoteResponse, true);
    
    // Extract the quote content and author
    $quoteContent = $quoteData['content'];
    $quoteAuthor = $quoteData['author'];
    
    // Generate the formatted quote message
    $formattedQuote = "\"{$quoteContent}\"\n- {$quoteAuthor}";
    
    // Send the random quote as a message
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => $formattedQuote,
        'reply_to_message_id' => $message_id
    ]);
}
?>
