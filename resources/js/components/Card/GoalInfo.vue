<template>

  <v-card
  >
  
  <v-card-text>
      <v-layout row col>
      <v-text-field
            v-model="viewname"
            label="Nombre de la meta"
            prepend-icon="far fa-flag"
            readonly
        ></v-text-field>
      <v-text-field
            v-model="viewquantity"
            label="Cantida de los objetivos"
            prepend-icon="fas fa-sort-numeric-up"
            readonly
        ></v-text-field>
    </v-layout>
      <v-layout row col>
    <template v-if="this.goal.estatud === 1">
      <v-text-field
            v-model="P"
            label="Estatud"
            prepend-icon="far fa-circle"
            readonly
        ></v-text-field>
    </template>
    <template v-else>
      <v-text-field
            v-model="F"
            label="Estatud"
            prepend-icon="fas fa-circle"
            readonly
        ></v-text-field>
    </template>
        <v-text-field
            v-model="viewCA"
            label="Fecha de creacion del proyecto"
            prepend-icon="far fa-calendar-alt"
            prepend-icon-color="blue"
            readonly
      ></v-text-field>
    </v-layout>
  </v-card-text>
  
  </v-card>
</template>

<script>
  export default {
    props: ['id'],
    data () {
      return {
        F: 'Finalizado',
        P: 'En proceso',
        viewname: '',
        viewquantity: '',
        viewCA: '',
        goal: [],
      }
    },

    mounted() {
      this.getGoal();
    },

    methods: {
        
        getGoal () {
          var url= "/api/goals/info/" + this.id;
            axios.get(url).then(response=>{
                this.goal = response.data;
                this.viewname = this.goal.name;
                this.viewquantity = this.goal.quantity;
                this.viewCA = this.goal.created_at;
            });
        },
       
    },
    
  }
</script>