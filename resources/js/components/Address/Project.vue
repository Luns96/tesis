<template>
  <v-card>
    <v-layout row col>
      <v-text-field
            v-model="viewquantity"
            label="Cantida de los objetivos"
            prepend-icon="fas fa-sort-numeric-up"
            readonly
      ></v-text-field>
      <v-text-field
            v-model="quantity"
            label="Cantida de objetivos sin completar"
            prepend-icon="fas fa-sort-numeric-up"
            readonly
        ></v-text-field>
    </v-layout>
  </v-card>
</template>

<script>
  export default {
    props: ['id'],
    data () {
      return {
          goal: '',
          viewquantity: '',
      }
    },

    mounted() {
        this.getGoal ()
    },
     methods: {

        getGoal () {
        var url= "/api/goals/info/" + this.id;
        axios.get(url).then(response=>{
            this.goal = response.data;
            this.viewquantity = this.goal.quantity;
            });
        },
    },
        
    
  }
</script>