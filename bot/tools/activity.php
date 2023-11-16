<?php
if(strpos($message, "/activity") === 0 || strpos($message, "!activity") === 0 || strpos($message, ".activity") === 0){
    
    // Get the JSON response from the Bored API
    $activityJson = file_get_contents("https://www.boredapi.com/api/activity?");
    // Decode the JSON response into an associative array
    $activityArray = json_decode($activityJson, true);
    // Extract the activity from the array
    $activity = $activityArray['activity'];

    // Stylized message format
    $responseMessage = "<b>🌟 Let's Make Today Interesting 🌟</b>\n\n" .
                       "<b>Hey @$username!</b>\n" .
                       "Here's a random activity for you to spice up your day:\n\n" .
                       "🚀 <b>Activity:</b> <i>" . htmlspecialchars($activity) . "</i>\n\n" .
                       "Have fun and enjoy every moment! 😄";

    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=> $responseMessage,
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
    ]);
}
?>
