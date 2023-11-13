<?php 

if(strpos($message, "/search") === 0 || strpos($message, "!search") === 0 || strpos($message, ".search") === 0) {
    // Get the search query
    $query = str_replace("/search", "", $message);
    $query = str_replace("!search", "", $query);
    $query = str_replace(".search", "", $query);
    $query = trim($query);

    // Do the Google Search
    $start_time = time();
    $search_url = "https://www.google.com/search?q=".urlencode($query);
    $html = file_get_contents($search_url);

    // Extract all the URLs
    $urls = array();
    preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', $html, $matches);
    foreach ($matches['href'] as $match) {
        if (strpos($match, 'url?q=') !== false && strpos($match, 'webcache') === false) {
            $url = str_replace('/url?q=', '', $match);
            $url = urldecode($url);
            $urls[] = $url;
        }
    }

    // Create a file with the URLs
    $end_time = time();
    $url_file = fopen("urls.txt", "w");
    foreach ($urls as $url) {
        fwrite($url_file, $url.PHP_EOL);
    }
    fclose($url_file);

    // Send the message to the user
    $url_count = count($urls);
    $total_time = $end_time - $start_time;
    bot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"

Number of Results: ".$url_count."

Time Taken: ".$total_time." seconds",
        'parse_mode'=>'html',
        'reply_to_message_id'=> $message_id
    ]);
    
    // Send the URL file
    if ($url_count > 0) {
        bot('senddocument', [
            'chat_id' => $chat_id,
            'document' => new CURLFile('urls.txt'),
            'caption' => "Search Results for: ".$query,
            'reply_to_message_id' => $message_id
        ]);
    }
}

?>
