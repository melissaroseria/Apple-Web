// Modal açma
function openChatModal(userName) {
    document.getElementById('chatUser').textContent = `Chat with ${userName}`;
    document.getElementById('chatModal').style.display = "block";
}

// Modal kapama
function closeChatModal() {
    document.getElementById('chatModal').style.display = "none";
}

// Mesaj gönderme
function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value.trim();
    
    if (message !== "") {
        const messageElement = document.createElement('div');
        messageElement.textContent = `You: ${message}`;
        document.getElementById('messages').appendChild(messageElement);
        messageInput.value = ''; // Mesajı gönderince inputu temizle
    }
}

// Enter tuşu ile mesaj gönderme
document.getElementById('messageInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
});