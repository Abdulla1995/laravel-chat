<template>
       <!-- <chat-messages v-if="messages1.length > 0"
                :user="user1"
                :receiver="receiver1"
                :messages="messages1"></chat-messages>-->
    <div class="col-md-8" v-show="messages.length > 0">
        <div class="panel panel-default ">
            <div class="panel-heading text-primary">Messages</div>
            <div class="panel-body">
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
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input id="btn-input" type="text" name="message"
                           class="form-control input-sm"
                           placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" id="btn-chat" @click="sendMessage">
                            Send
                        </button>
                    </span>
                </div>
                <p class="text-danger" v-if="showError">{{showError}}</p>
            </div>
        </div>
    </div>
</template>

<script>
    import ChatMessages from "./ChatMessages.vue";

    export default {
        components: {ChatMessages},
        props: ['user',
        'receiver',
        'messages',
        'errors'],

        data() {
            return {
                newMessage: '',
                messagesMain: this.messages,
                messagesFromChat: [{name: ''}],
                messageLeft: null,
                userName: null,
                showError: null
            }
        },
        methods: {
            sendMessage() {
                if (this.newMessage !== '') {
                    this.$emit('messagesent', {
                        name: this.user.name,
                        message: this.newMessage,
                        receiver_id: this.receiver
                    });
                }else {
                    this.showError = 'Mesaj bosh qala bilmez'
                }



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