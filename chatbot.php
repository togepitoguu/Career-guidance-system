<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMessage = strtolower(trim($_POST["message"]));

    $responses = [
        "hi" => "Hello! How can I help you with your career planning?",
        "hello" => "Hi there! What career guidance are you looking for?",
        "what should i do after 12th" => "It depends on your stream and interests. Science opens up options like Engineering, Medicine, or Research. Commerce can lead to CA, BBA, or Economics. Arts includes fields like Law, Design, and Humanities.",
        "bye" => "Goodbye! Wishing you the best in your career journey!",
        "default" => "Sorry, I didn’t understand that. Could you please rephrase your question?"
    ];

    $botReply = $responses[$userMessage] ?? $responses["default"];

    echo json_encode(["reply" => $botReply]);
    exit;
}
?>
