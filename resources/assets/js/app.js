
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
Vue.component('chat-users', require('./components/ChatUser.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        receiver_id: null,
        usersInRoom: null
    },

    created() {

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    name: e.user.name
                });

            });

        Echo.join('chat')
            .here((users) =>{
                this.usersInRoom = users;
            })
            .joining()
            .leaving()
            .listen('MessageSent', (e) =>{
                console.log(e)
            });

    },

    methods: {

        sendMessage(message) {
            this.messages.push(message);
            axios.post('/messages', message)
                .then(response => {
            }).catch(e => {
                console.log(e.response);
            });
        },

        getUserId(id)
        {
            this.receiver_id = id;
            this.getUserMessages(id);
        },

        getUserMessages(id)
        {
            axios.get('/messages/' + id)
                .then(response => {
                    this.messages = response.data
                }).
                catch(e=> {
                    console.log(e)
                })
        }
    }
});
