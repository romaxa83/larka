<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2>Echo-chat</h2>

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
                messages: [],
                textMessage: ''
            }
        },
        mounted() {
            console.log('ECHO-CHANNEL for socket to resources/js/components/EchoChat.vue');

            // window.Echo.channel('echo-chat')
            //     .listen('EchoChatEvent', ({message}) => {
            //         this.messages.push(message.body)
            //     })

        },
        methods: {
            sendMessage() {
                axios.post('/echo-chat/messages', {body: this.textMessage});
                this.messages.push(this.textMessage);
                this.textMessage = '';
            }
        }
    }
</script>