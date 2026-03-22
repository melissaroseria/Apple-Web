let activeChatId = null;

function openChat(name, id) {
    activeChatId = id;
    document.getElementById('chat-name').innerText = name;
    document.getElementById('chat-avatar').innerText = name.charAt(0);
    
    // Listeyi kaydır ve Chat'i getir
    document.getElementById('list-screen').style.display = 'none';
    document.getElementById('chat-screen').style.display = 'flex';
}

function closeChat() {
    document.getElementById('chat-screen').style.display = 'none';
    document.getElementById('list-screen').style.display = 'flex';
}

// Mesajı Telegram'a Uçur
document.getElementById('tgForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const input = document.getElementById('msgInput');
    const msg = input.value.trim();
    
    if(!msg || !activeChatId) return;

    addBubble('sender', msg);
    input.value = "";

    await fetch('api/send.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ chat_id: activeChatId, text: msg })
    });
});
