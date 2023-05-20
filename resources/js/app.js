import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

if (document.getElementById('chat')) {
    const token = document.head.querySelector('meta[name="token"]').content;
    const chatRoomId = document.getElementById('chat').getAttribute('data-chat-room-id')
    let lastMessageId = document.getElementById('chat').getAttribute('data-last-message-id');
    const chat = document.getElementById('chat');
    const requestLastMessage = function () {
        axios.get('/api/chat_rooms/'+chatRoomId+'/last?lastMessageId=' + lastMessageId, {
            headers: {
                Authorization: 'Bearer ' + token,
            }
        }).then(response => {
            if (response.data) {
                lastMessageId = response.data.lastMessageId;
                chat.innerHTML = chat.innerHTML + response.data.html;
                if(!(chat.scrollTop < chat.scrollHeight)){
                    chat.scrollTop = chat.scrollHeight;
                }
            }
        });
    };

    setInterval(() => requestLastMessage(), 1000);
    chat.scrollTop = chat.scrollHeight;
}
