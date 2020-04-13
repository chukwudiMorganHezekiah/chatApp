


<template>
    <div id="conversation" ref="feed">
        <h1 style="text-align:center">{{'ChatApp'}}</h1>

        <div class="messages" v-for="messageing in messages" v-bind:key="messageing.id">

            <div class="" v-for="message in messageing" v-bind:class="`message${user==message.to ?'sent' :'recieved'}`" v-bind:key="message.id">

                {{message.message}}
               


                </div>



        </div>

 <messagewriter v-on:send="send($event)"/>

    </div>
</template>

<script>
import messagewriter from './messagewriter.vue'

export default {
    components:{
        'messagewriter':messagewriter


    },
    data(){
       return{
            chattingwith:0
       }
    },
    methods:{
        send(text){
            var vue=this;


            axios.post('/postamessage',{contact_id:this.using,message:text}).then(function(res){
                console.log(res.data)

                vue.$emit('sending',res.data);

            })
        },
         scrollToBottom:function (){
            setTimeout(()=>{
                 this.$refs.feed.scrollTop=this.$refs.feed.scrollHeight-this.$refs.feed.clientHeight;

            },50)


        }


    },
    props:{
        user:{
            required:true,

        },
        using:{
            required:true,

        },

        messages:{
            type:Array,
            default:[],
        }
    },
   created(){


   }

}
</script>

<style scoped>

.messagerecieved{
    background:rgb(171, 171, 211);
    text-align:right;
    float:right;
    padding:20px;
    margin:10px;
     width:50%;
     border-radius: 4px;



}
.messagesent{
    background:lightgray;
    text-align:left;
    float:left;
      padding:20px;
    margin:10px;
    border-radius: 4px;
    width:50%;
}

#conversation{
    max-height: 600px;
    overflow-y: scroll;


}




</style>
