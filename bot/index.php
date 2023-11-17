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
bot('sendmessage',[
    'chat_id'=>$chat_id,
    'photo'=>"<b> https://imgur.com/t/yuno_gasai/B4eUBtf</b>",
    'text'=>"Benvenuto nel bot i propietari sono $bowner",
    'parse_mode'=>'html',
    'reply_to_message_id'=> $message_id,
    'reply_markup'=>json_encode(['inline_keyboard'=>[
    [['text'=>"Menu",'callback_data'=>"Menu"]],
    ],'resize_keyboard'=>true])
    ]);
  }
if($data == "Menu"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"Comandi del bot",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"comandi sesso",'callback_data'=>"sex"]],
 [['text'=>"tools",'callback_data'=>"tools"]],
    [['text'=>"games",'callback_data'=>"games"]],
       [['text'=>"funny commands",'callback_data'=>"funny"]],
  ],'resize_keyboard'=>true])
  ]);
  }
if($data == "tools")(
	bot('editMessageText',[
	'chat_id'=>$callbackchatid,
	    'message_id'=>$callbackmessageid,
	    'text'=>"╔═════════════════╗
    

⋆ Genrerate an activity when youre bored
⋆ Format: /activity 
━━━━━━━━━━━━━━━━━
⋆ Basic calculator 
⋆ Format: /calculate 69 + 69
━━━━━━━━━━━━━━━━━
⋆ File to link
⋆ Format: /upload (File)
━━━━━━━━━━━━━━━━━
⋆ 𝗖𝗛𝗘𝗖𝗞 𝗧𝗘𝗟𝗘𝗚𝗥𝗔𝗠 𝗜𝗗/𝗚𝗥𝗢𝗨𝗣 𝗜𝗗
⋆ Format: /id
━━━━━━━━━━━━━━━━━
⋆ Fake identity generator
⋆ Format: /fake
━━━━━━━━━━━━━━━━━
⋆ Get Hacker News
⋆ Format: /hacknews
━━━━━━━━━━━━━━━━━
⋆ Generate ip and scans location
⋆ Format: /ip
━━━━━━━━━━━━━━━━━
⋆ Generate urls
⋆ Format: /search
━━━━━━━━━━━━━━━━━
⋆ QR code generator
⋆ /generateqr (text)
━━━━━━━━━━━━━━━━━
⋆ Check website ping
⋆ Format: /wbpi (url)
━━━━━━━━━━━━━━━━━
⋆ Upload files on ANON
⋆ Format: /uploadanon (file)
━━━━━━━━━━━━━━━━━
⋆ Check weather in a city
⋆ Format: /wthr
╚═════════════════╝
",
	    'parse_mode'=>'html',
	    'disable_web_page_preview'=>true,
	     'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"return",'callback_data'=>"Menu"]],
 ],'resize_keyboard'=>true])
  ]);
  }
if($data == "Menu"){
    bot('editMessageText',[
    'chat_id'=>$callbackchatid,
    'message_id'=>$callbackmessageid,
    'text'=>"Comandi del bot",
    'parse_mode'=>'html',
    'disable_web_page_preview'=>true,
        'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"comandi sesso",'callback_data'=>"sex"]],
 [['text'=>"tools",'callback_data'=>"tools"]],
    [['text'=>"games",'callback_data'=>"games"]],
       [['text'=>"funny commands",'callback_data'=>"funny"]],
  ],'resize_keyboard'=>true])
  ]);
  }
if($data == "games")(
	bot('editMessageText',[
	'chat_id'=>$callbackchatid,
	    'message_id'=>$callbackmessageid,
	    'text'=>"╔═════════════════╗
⋆ Play roulette
⋆ Format: /roulette 
━━━━━━━━━━━━━━━━━
⋆ Play Slots 
⋆ Format: /Slot
╚═════════════════╝
",
	    'parse_mode'=>'html',
	    'disable_web_page_preview'=>true,
	     'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"return",'callback_data'=>"Menu"]],
 ],'resize_keyboard'=>true])
  ]);
  }
if($data == "games")(
	bot('editMessageText',[
	'chat_id'=>$callbackchatid,
	    'message_id'=>$callbackmessageid,
	    'text'=>"╔═════════════════╗
⋆ Check how gay you are
⋆ Format: /gay 

╚═════════════════╝
",
	    'parse_mode'=>'html',
	    'disable_web_page_preview'=>true,
	     'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"return",'callback_data'=>"Menu"]],
 ],'resize_keyboard'=>true])
  ]);
  }


	    
	    
