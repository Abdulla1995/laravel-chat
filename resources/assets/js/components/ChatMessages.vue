<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        {{ userName }}
                    </strong>
                </div>
                <p :style="messageLeft">
                    {{ message.message }}
                </p>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'ChatMessages',
        props:
            ['messages',
                'user',
                'receiver'
            ],

        data(){
            return {
                messagesFromChat: [{name: ''}],
                messageLeft: null,
                userName: null
            }
        },

        methods: {
            messageReceiver()
            {

                if (this.user.id !== this.receiver){
                    this.messageLeft = 'text-align:left; background:green; color:white';
                    this.userName = this.messagesFromChat[0].name
                }

            }
        },

        created(){
            this.messageReceiver();
//            if (this.messages[0])
//                console.log(this.messages);

//            console.log(this.user);
//            console.log(this.messages);
        },

    };
</script>