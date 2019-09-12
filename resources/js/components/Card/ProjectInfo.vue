<template>

  <v-card
  >
  <v-btn
          color="purple" 
          icon
          @click="returnProject()"
        >
        <i class="fas fa-arrow-left" style="color:white"></i>
      </v-btn>
  <v-card-text>
    <v-layout row col>
      <v-textarea
            rows="2"
            v-model="viewProjectMission"
            label="Mision"
            prepend-icon="far fa-comment-alt"
            readonly
        ></v-textarea>
        <v-textarea
            rows="2"
            v-model="viewProjectVision"
            label="Vision"
            prepend-icon="fas fa-comment-alt"
            readonly
      ></v-textarea>
    </v-layout>
      <v-layout row col>
    <template v-if="this.project.estatud === 1">
      <v-text-field
            rows="2"
            v-model="P"
            label="Estatud"
            prepend-icon="far fa-circle"
            readonly
        ></v-text-field>
    </template>
    <template v-else>
      <v-text-field
            rows="2"
            v-model="F"
            label="Estatud"
            prepend-icon="fas fa-circle"
            readonly
        ></v-text-field>
    </template>
        <v-text-field
            rows="2"
            v-model="viewProjectCA"
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
        viewProjectMission: '',
        viewProjectVision: '',
        viewProjectCA: '',
        project: [],
      }
    },

    mounted() {
      this.getProject();
    },

    methods: {

        getProject () {
          var url= "/api/project/info/" + this.id;
            axios.get(url).then(response=>{
                this.project = response.data;
                this.viewProjectMission = this.project.mission;
                this.viewProjectVision = this.project.vision;
                this.viewProjectCA = this.project.created_at;
            });
        },
         returnProject(){
          var url = '/project';
          window.location.href = url;
        },
    },
    
  }
</script>