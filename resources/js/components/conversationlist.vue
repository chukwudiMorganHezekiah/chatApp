<template>
    <div class="container" id="list" ref="list">


<div v-for="contacting in sortContacts" v-bind:key="contacting.id">

            <div v-for="(contact,index) in contacting" v-bind:key="contact.id" v-bind:class="{'active':index==select}" v-on:click="selected(index,`${contact.id}`)">

<span class="unread" > {{contact.unread }}</span>

            <div class="avatar">
                <img v-bind:src="contact.profile_image" v-bind:alt="contact.name">

                </div>

                <p class="name">{{contact.name}}</p>
                <p class="text-muted">{{contact.email}}</p>

                <hr />

        </div>


    </div>

    </div>
</template>

<script>

    export default {
        props:{
            contacts:{
                type:Array,
                required:true,
                dafault:[]
            }

        },

        data(){
            return{
                select:0,
                show:false

            }
        },
        methods:{
            selected(index){
                this.select=index;

                this.$emit('selected',index);

            },
            scrollToBottom:function (){
            setTimeout(()=>{
                console.log(this.$refs);
                 this.$refs.feed.scrollTop=this.$refs.feed.scrollHeight-this.$refs.feed.clientHeight;

            },50)


        }

        },
         computed:{
             sortContacts:function (){
                return _.sortBy(this.contacts,[(contact)=>{
                   return contact.unread;

                }]).reverse();
            }

        },

        watch:{
            contacts(contacts){
                this.scrollToBottom();
            }

        },
        mounted() {
            console.log(this.contacts)
        }
    }
</script>

<style lang="scss" scoped>

#list{
    max-height: 600px;
    overflow-y: scroll;
    border-left:1px #333 solid;
    div{
        cursor:pointer;
        align-items: center;
        font-size: 10px;
        font-weight: bold

    }
}
.active{
    background: rgb(233, 231, 231);
    width:100%;
    padding:10px;

}
.unread{
        background: green;
    padding: 10px;
            border-radius: 0px;
            color: white;
            justify-content: center;

            top: 5px;
    right: 50px
}


</style>
