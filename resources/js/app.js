import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine

let chatInterval = null;

const openChat = function (id) {
    const token = document.head.querySelector('meta[name="token"]').content;
    console.log(id)
    const chatRoomId = id;
    let lastMessageId = null;
    const chatDiv = document.getElementById('chat');
    chatDiv.innerHTML = '';
    const chatLoading = document.getElementById('chat-loading');

    const scrollToBottom = function () {
        chatDiv.parentElement.scrollTop = chatDiv.parentElement.scrollHeight;
    }

    const requestLastMessage = async function () {
        if (lastMessageId === null) {
            chatLoading.style.display = 'flex';
        }

        try {
            const response = await axios.get('/api/chat_rooms/'+chatRoomId+'/last?lastMessageId=' + lastMessageId, {
                headers: {
                    Authorization: 'Bearer ' + token,
                }
            });

            if (response.data) {
                let scrollRequired = lastMessageId === null;

                lastMessageId = response.data.lastMessageId;
                const newData = chatDiv.innerHTML + response.data.html;
                if (newData !== chatDiv.innerHTML) {
                    chatDiv.innerHTML = newData;
                }

                if (! (chatDiv.scrollTop < chatDiv.scrollHeight) || scrollRequired) {
                    scrollToBottom();
                }
            }
        } catch (error) {
            console.error(error);
        } finally {
            chatLoading.style.display = 'none';
        }
    };

    clearInterval(chatInterval);
    chatInterval = setInterval(() => requestLastMessage(), 1000);
    chatLoading.style.display = 'flex';
};

window.openChat = openChat;

function toggleClassOpacity(checkbox) {
    const label = checkbox.parentElement.querySelector(".class-label");
        if (checkbox.checked) {
            label.style.opacity = 0.5;
        } else {
            label.style.opacity = 1;
        }
}

window.toggleClassOpacity = toggleClassOpacity;

Alpine.start()
