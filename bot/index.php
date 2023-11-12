<?php
include __DIR__."/config/variables.php";
include __DIR__."/config/users.php";
include __DIR__."/functions/bot.php";
include_once __DIR__."/functions/functions.php";
//////////////////////////////////////////////////////////////////////////
if(strpos($message, "/start") === 0){
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"<b>Hello @$username,

Type /cmds to know all my commands!</b>",
	'parse_mode'=>'html',
	'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard' => [
        [
          ['text' => "Owner 1", 'url' => "tg://user?id=1058653930"]
        ],
        [
          ['text' => "Owner 2", 'url' => "il tuo telegram id qui"]
        ],
          ['text' => "dashboard", 'url' => "dashboard qui"]
        ],
      ], 'resize_keyboard' => true])
        
    ]);
}
