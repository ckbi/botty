<?php
// Check if the message starts with specific commands for file upload
if(strpos($message, "/uploadanon") === 0 || strpos($message, "!uploadanon") === 0 || strpos($message, ".uploadanon") === 0){

    // Assuming the file is sent as a POST request to the script
    // and the file input name is 'fileToUpload'
    if(isset($_FILES['fileToUpload'])) {
        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options for file upload
        curl_setopt($ch, CURLOPT_URL, 'https://api.anonfiles.com/upload');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'file' => curl_file_create($_FILES['fileToUpload']['tmp_name'], $_FILES['fileToUpload']['type'], $_FILES['fileToUpload']['name'])
        ]);

        // Execute cURL session and get the response
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the JSON response
        $result = json_decode($response, true);

        // Check if we got a valid response
        if($result && isset($result['status']) && $result['status']) {
            // Prepare the file upload message
            $fileUrl = $result['data']['file']['url']['full'];
            $uploadMessage = "<b>📤 File Uploaded Successfully 📤</b>\n\n" .
                             "<b>🔗 Your File Link:</b> " . $fileUrl;

            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> $uploadMessage,
                'parse_mode'=>'html',
                'reply_to_message_id'=> $message_id
            ]);
        } else {
            // Handle error
            $errorMessage = isset($result['error']['message']) ? $result['error']['message'] : "Sorry, I couldn't upload the file at this time.";
            bot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=> $errorMessage,
                'parse_mode'=>'html',
                'reply_to_message_id'=> $message_id
            ]);
        }
    } else {
        // No file was uploaded
        bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=> "Please upload a file.",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id
        ]);
    }
}
?>
