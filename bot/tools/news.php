<?php
// Check if the message starts with specific commands
if(strpos($message, "/hacknews") === 0 || strpos($message, "!hacknews") === 0 || strpos($message, ".hacknews") === 0){

    // Fetch the top stories IDs from Hacker News
    $topStoriesJson = file_get_contents("https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty");
    // Decode the JSON response into an array of IDs
    $topStoriesIds = json_decode($topStoriesJson, true);

    // Limit the number of stories to display
    $topStoriesIds = array_slice($topStoriesIds, 0, 5);

    // Initialize an array to hold the stories
    $topStories = [];

    // Fetch details for each story
    foreach($topStoriesIds as $storyId) {
        $storyJson = file_get_contents("https://hacker-news.firebaseio.com/v0/item/{$storyId}.json?print=pretty");
        $storyDetails = json_decode($storyJson, true);
        $topStories[] = $storyDetails;
    }

    // Prepare the message with the top stories
    $storiesMessage = "<b>📰 Top Hacker News Stories 📰</b>\n\n";
    foreach($topStories as $story) {
        $storiesMessage .= "<b>Title:</b> " . htmlspecialchars($story['title']) . "\n";
        $storiesMessage .= "<b>URL:</b> " . htmlspecialchars($story['url']) . "\n\n";
    }

    // Send the message with the top stories
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=> $storiesMessage,
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
    ]);
}
?>
