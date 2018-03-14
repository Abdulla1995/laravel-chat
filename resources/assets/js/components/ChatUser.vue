<template>
    <div>
        <div class="panel-heading text-primary">Users</div>
        <ul class="list-group">
            <li class="list-group-item"
                style="cursor: pointer"
                v-for="user in users">
                <button style="cursor: pointer" class="form-control"
                        @click="getUserMessages(user.id)">{{user.name}}</button>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: 'ChatUser',
        data() {
            return {
                users: []
            }
        },

        methods: {
            getAllUsers()
            {
                axios.get('/allusers')
                    .then(response =>{
                       this.users = response.data
                    })
            },

            getUserMessages(id)
            {
                this.$emit('userid', id);
            }
        },

        created()
        {
            this.getAllUsers();
        }
    }
</script>