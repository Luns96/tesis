<template>
  <v-card>
    <template v-if="this.goal.estatud === 1">
        <div class="alert-warning">
           <v-layout row col>
          <v-textarea
            rows = '2'
            v-model="viewName"
            label="Objetivo de la meta"
            prepend-icon="far fa-flag"
            readonly
          ></v-textarea>
          <v-text-field
            v-model="showCF"
            label="Fecha de inicio:"
            prepend-icon="far fa-calendar-alt"
            readonly
            ></v-text-field>
            <v-text-field
            v-model="showAF"
            label="Fecha de culminacion:"
            prepend-icon="fa fa-calendar-alt"
            readonly
            ></v-text-field>
            <v-text-field
            v-model='estatud'
            label="Estatud"
            prepend-icon="far fa-circle"
            readonly
            ></v-text-field>
        </v-layout>
        </div>
      </template>
      <template v-if="this.goal.estatud === 4">
         <div class="alert-dark">
            <v-layout row col>
          <v-textarea
            rows = '2'
            v-model="viewName"
            label="Objetivo de la meta"
            prepend-icon="far fa-flag"
            readonly
          ></v-textarea>
          <v-text-field
            v-model="showCF"
            label="Fecha de inicio:"
            prepend-icon="far fa-calendar-alt"
            readonly
            ></v-text-field>
            <v-text-field
            v-model="showAF"
            label="Fecha de culminacion:"
            prepend-icon="fa fa-calendar-alt"
            readonly
            ></v-text-field>
            <v-text-field
            v-model='estatud'
            label="Estatud"
            prepend-icon="far fa-hand-paper"
            readonly
            ></v-text-field>
        </v-layout>
         </div>
      </template>
      <template v-if="this.goal.estatud === 3">
         <div class="alert-danger">
            <v-layout row col>
          <v-textarea
            rows = '2'
            v-model="viewName"
            label="Objetivo de la meta"
            prepend-icon="far fa-flag"
            readonly
          ></v-textarea>
          <v-text-field
            v-model="showCF"
            label="Fecha de inicio:"
            prepend-icon="far fa-calendar-alt"
            readonly
            ></v-text-field>
            <v-text-field
            v-model="showAF"
            label="Fecha de culminacion:"
            prepend-icon="fa fa-calendar-alt"
            readonly
            ></v-text-field>
            <v-text-field
            v-model='estatud'
            label="Estatud"
            prepend-icon="fas fa-times"
            readonly
            ></v-text-field>
        </v-layout>
         </div>
      </template>
  </v-card>
</template>

<script>
  export default {
    props: ['id'],
    data () {
      return {
          goal: '',
          viewName: '',
          showCF: '',
          showAF: '',
          estatud: '',
      }
    },

    mounted() {
        this.getGoal ()
    },
     methods: {

        getGoal () {
        var url= "api/goal/show/" + this.id;
        axios.get(url).then(response=>{
            this.goal = response.data;
            console.log();
            this.viewName = this.goal.name;
            this.showAF = this.goal.start;
            this.showCF = this.goal.finish;
            if(this.goal.estatud == 1){
              this.estatud = 'En proceso'
            }else{
              if(this.goal.estatud == 3){
                this.estatud = 'Retrasado'
              }else{
                this.estatud = 'En espera'
              }
            }            
            });
        },
    },
        
    
  }
</script>