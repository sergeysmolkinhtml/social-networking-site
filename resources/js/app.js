
import './bootstrap';
import * as Vue from '@vitejs/plugin-vue'
import ChatForm from "@/Components/ChatForm.vue";
import ChatMessages from "@/Components/ChatMessages.vue";

const app = Vue({
    el: '#app',
    //Store chat messages for display in this array.
    data: {
        messages: []
    },
    //Upon initialisation, run fetchMessages().
    created() {
        this.fetchMessages();
    },
    methods: {
        fetchMessages() {
            //GET request to the messages route in our Laravel server to fetch all the messages
            axios.get('/messages').then(response => {
                //Save the response in the messages array to display on the chat view
                this.messages = response.data;
            });
        },
        created(){
            window.Echo.private('chat')
                .listen('MessageSent', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                });
        },

        addMessage(message) {
            //Pushes it to the messages array
            this.messages.push(message);
            //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        }
    },
    components:{
        ChatForm,
        ChatMessages
    }
})




