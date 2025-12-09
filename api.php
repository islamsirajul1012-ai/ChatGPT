<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$data = json_decode(file_get_contents("php://input"), true);

$message = $data["message"] ?? "";

$ch = curl_init("https://api.openai.com/v1/chat/completions");

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: " . "Bearer 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"
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "user", "content" => $message]
    ]
]));

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>