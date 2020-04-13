<template>
    <div class="container mb-5 " id="main">
        <div class="row">
        <div class="col-lg-7">
            <conversation  v-bind:messages="messages"  v-bind:user="user" v-on:sending="sending($event)" :using="using" />

            </div>

            <div class="col-lg-5">

                <conversationlist v-bind:contacts="contacts" v-on:selected="startConversationWith($event)"/>

            </div>

            </div>



    </div>
</template>

<script>

import ConversationList from './conversationlist.vue';
import conversation from './conversation.vue';
    export default {
        props:{
            user:{

                required:true,
            }

        },
        data(){
            return{
                contacts:[],
                messages:[],
                using:0,

            }
        },
        mounted() {
            var vue=this;

            axios.get('/allUsers').then(function(res){

                vue.contacts.push(res.data);
            })
        },
        methods:{
            startConversationWith(index){
                this.messages=[];
                var vue=this;
                this.using=index;
                axios.get(`/selectallconversations/${index}`).then(function(res){
                    vue.messages.push(res.data);


                })

            },
              
            sending(text){
                console.log(this.messages)

               this.messages.forEach((datum)=>{
                   datum.push(text);

               })

            }

        },

        components:{
            'conversationlist':ConversationList,
            'conversation':conversation,

        }
    }
</script>
