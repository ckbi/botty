<?php
include __DIR__."/../config/variables.php";
include __DIR__."/config/users.php";
include_once __DIR__."/../functions/bot.php";
include_once __DIR__."/../functions/functions.php";





if ((strpos($message, "/info") === 0)||(strpos($message, "!id") === 0)||(strpos($message, ".id") === 0)||(strpos($message, "!info") === 0)||(strpos($message, "/id") === 0)||(strpos($message, "/me") === 0)){
    
    bot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"<b>ID Lookup</b> ✅

<b>Your ID:</b> <code>$userId</code>
<b>Group ID: </b><code>$chat_id</code>
<b>User</b>: @".$username."
",
            'parse_mode'=>'html',
            'reply_to_message_id'=> $message_id
            ]);
}


?>
