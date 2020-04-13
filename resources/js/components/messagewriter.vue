

<template>
    <div>

        <textarea  v-model="mess" @keydown.enter="send"/>

    </div>
</template>

<script>
export default {
    data(){
        return{
            mess:'',
        }
    },
    created(){
       

    },
    methods:{
        send(e){
            e.preventDefault();

            if(this.mess ==''){
                return;

            }else{
                this.$emit('send',this.mess);
                this.mess=''
            }
        }
    }

}
</script>

<style scoped>
textarea{
    width:100%;
    resize: none;
    position:absolute;
    border:1px solid lightgray;
    left:-2px;
    bottom:10px;

}
</style>
