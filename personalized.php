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

<!-- Basic Chat UI -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CareerGuide Chatbot</title>
  <style>
    body { font-family: Arial; padding: 20px; background: #f4f4f4; }
    .chatbox { background: #fff; padding: 20px; border-radius: 10px; max-width: 600px; margin: auto; }
    #chatlog { height: 300px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
    .input-row { display: flex; }
    #message { flex: 1; padding: 10px; }
    #sendBtn { padding: 10px; }
  </style>
</head>
<body>
  <div class="chatbox">
    <h2>CareerGuide Chatbot</h2>
    <div id="chatlog"></div>
    <div class="input-row">
      <input type="text" id="message" placeholder="Ask me a career question..." />
      <button id="sendBtn">Send</button>
    </div>
  </div>

  <script>
    const chatlog = document.getElementById('chatlog');
    const messageInput = document.getElementById('message');
    const sendBtn = document.getElementById('sendBtn');

    function addMessage(who, text) {
      const p = document.createElement("p");
      p.innerHTML = `<strong>${who}:</strong> ${text}`;
      chatlog.appendChild(p);
      chatlog.scrollTop = chatlog.scrollHeight;
    }

    sendBtn.onclick = () => {
      const message = messageInput.value.trim();
      if (message === "") return;

      addMessage("You", message);
      messageInput.value = "";

      fetch("chatbot.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "message=" + encodeURIComponent(message)
      })
      .then(res => res.json())
      .then(data => addMessage("Bot", data.reply))
      .catch(() => addMessage("Bot", "Sorry, something went wrong."));
    };
  </script>
</body>
</html>
