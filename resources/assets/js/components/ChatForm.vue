<template>
    <div v-if="messages.length > 0">
       <!-- <chat-messages v-if="messages1.length > 0"
                :user="user1"
                :receiver="receiver1"
                :messages="messages1"></chat-messages>-->

        <ul class="chat">
            <li class="left clearfix" v-for="sentMessage in messages">
                <div class="chat-body clearfix">

                    <strong class="primary-font">
                        {{ sentMessage.name }}
                    </strong>
                    <p :style="messageLeft">
                        {{ sentMessage.message }}
                    </p>

                </div>
            </li>
        </ul>

        <div class="input-group">
            <input id="btn-input" type="text" name="message"
                   class="form-control input-sm"
                   placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

            <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
        </div>
    </div>

</template>

<script>
    import ChatMessages from "./ChatMessages.vue";

    export default {
        components: {ChatMessages},
        props: ['user',
        'receiver',
        'messages'],

        data() {
            return {
                newMessage: '',
                messagesMain: this.messages,
                messagesFromChat: [{name: ''}],
                messageLeft: null,
                userName: null
            }
        },
        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                    receiver_id: this.receiver
                });

                this.newMessage = ''
            },

//            messageReceiver()
//            {
//                if (this.user.id !== this.receiver){
//                    this.messageLeft = 'text-align:left; background:green; color:white';
//                    this.userName = this.messagesFromChat[0].name
//                }
//            }


        },
    }
</script>