<template>
  
</template>

<script>
  export default {
    props: ['id'],
    data () {
      return {
          account: '',
      }
    },

    mounted() {
        this.getAccount ()
    },
     methods: {

        getAccount () {
        var url= "api/user/project/" + this.id;
        axios.get(url).then(response=>{
            this.account = response.data;
            console.log(this.account)
            });
        },
    },
        
    
  }
</script>