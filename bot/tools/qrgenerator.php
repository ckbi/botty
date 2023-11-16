<?php
// Check if the message starts with specific commands for generating a QR code
if(strpos($message, "/generateqr") === 0 || strpos($message, "!generateqr") === 0 || strpos($message, ".generateqr") === 0){

    // Extract the text to encode in the QR code from the message
    // Assuming the message format is "/generateqr some text here"
    $textToEncode = trim(substr($message, strpos($message, ' ') + 1));

    // Prepare the URL for the QR code API
    $qrApiUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($textToEncode);

    // Send the message with the QR code image URL
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=> "Here is your QR Code: " . $qrApiUrl,
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
    ]);
}
?>
