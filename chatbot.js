document.addEventListener("DOMContentLoaded", function () {
  const chatlog = document.getElementById("chatlog");
  const messageInput = document.getElementById("message");
  const sendBtn = document.getElementById("sendBtn");

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
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "message=" + encodeURIComponent(message),
    })
      .then((res) => res.json())
      .then((data) => addMessage("Bot", data.reply))
      .catch(() => addMessage("Bot", "Sorry, something went wrong."));
  };
});
