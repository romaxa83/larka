<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Private-chat</h2>

                <textarea class="form-control" disabled name="" cols="30" rows="10">{{ messages.join('\n') }}</textarea>
                <hr>
                <input class="form-control" type="text"
                       v-model="textMessage"
                       @keyup.enter="sendMessage">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function (){
            return {
                room: [],
                messages: [],
                textMessage: ''
            }
        },
        mounted() {
            console.log('PRIVATE-ECHO-CHANNEL for socket to resources/js/components/PrivateChat.vue');
            let id = this.$route.params.id;
            window.Echo.private('room.' + id)
                .listen('PrivateEchoChatEvent', ({data}) => {
                    this.messages.push(data.body)
                })

        },
        created() {
            let id = this.$route.params.id;

            axios.post('/room/' + id, {
            }).then(res => {
                this.room = res.data;
            })
        },
        methods: {
            sendMessage() {
                axios.post('/private-chat/messages', {body: this.textMessage, room_id: this.room.id});
                this.messages.push(this.textMessage);
                this.textMessage = '';
            }
        }
    }
</script>