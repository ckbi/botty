<?php
if (strpos($message, "/whois") === 0 || strpos($message, "!whois") === 0 || strpos($message, ".whois") === 0) {
    $domain = trim(substr($message, 7)); // Extract the domain from the message
    
    // Make a request to the WhoisXML API
    $apiKey = "at_eFp13AqG8YYEdeNoShbgHTNA0JOVZ";
    $url = "https://www.whoisxmlapi.com/whoisserver/WhoisService?apiKey=$apiKey&domainName=$domain";
    
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    
    if ($data['WhoisRecord']['status'] === "ERROR") {
        $result = "Error: Unable to retrieve WHOIS information for the domain.";
    } else {
        $result = "Domain: " . $data['WhoisRecord']['domainName'] . "\n";
        $result .= "Registrar: " . $data['WhoisRecord']['registrarName'] . "\n";
        $result .= "Registered Date: " . $data['WhoisRecord']['createdDate'] . "\n";
        $result .= "Expiration Date: " . $data['WhoisRecord']['expiresDate'] . "\n";
        $result .= "Registrant Name: " . $data['WhoisRecord']['registrant']['name'] . "\n";
        $result .= "Registrant Organization: " . $data['WhoisRecord']['registrant']['organization'] . "\n";
        $result .= "Admin Name: " . $data['WhoisRecord']['admin']['name'] . "\n";
        $result .= "Admin Organization: " . $data['WhoisRecord']['admin']['organization'] . "\n";
        $result .= "Admin Email: " . $data['WhoisRecord']['admin']['email'] . "\n";
        $result .= "Tech Name: " . $data['WhoisRecord']['technical']['name'] . "\n";
        $result .= "Tech Organization: " . $data['WhoisRecord']['technical']['organization'] . "\n";
        $result .= "Tech Email: " . $data['WhoisRecord']['technical']['email'] . "\n";
        // Add more relevant WHOIS information as needed
    }
    
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => $result,
        'reply_to_message_id' => $message_id
    ]);
}
?>
