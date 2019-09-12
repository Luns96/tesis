<template>
  <v-card>
      <v-dialog
          width="500"
          v-model="dialogCreate"
        >
          <v-card>
            <v-card-title
              class="headline grey lighten-2"
              primary-title
            >
              <i class="fa fa-plus" style="color:green"></i>
                &nbsp;
              Agregar
            </v-card-title>
              <v-form
                  method="post"
                  ref="formAdd"
                  v-model="validAdd"
                  lazy-validation
                  >
            <v-card-text>
                <v-textarea
                    rows="2"
                    prepend-icon="far fa-flag"
                    v-model="addName"
                    :rules= "NameRules"
                    label="objectivo"
                    required
                ></v-textarea>
                <v-layout row col>
                    <v-dialog
                        ref="dialogstart"
                        v-model="modalstart"
                        :return-value.sync="datestart"
                        persistent
                        full-width
                        width="290px"
                    >
                        <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="datestart"
                            label="fecha de comienzo"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                        ></v-text-field>
                        </template>
                        <v-date-picker v-model="datestart" scrollable>
                        <div class="flex-grow-1"></div>
                        <v-btn text color="primary" @click="modalstart = false">Cancel</v-btn>
                        <v-btn text color="primary" @click="$refs.dialogstart.save(datestart)">OK</v-btn>
                        </v-date-picker>
                    </v-dialog>
                    <v-dialog
                        ref="dialogfinish"
                        v-model="modalfinish"
                        :return-value.sync="datefinish"
                        persistent
                        full-width
                        width="290px"
                    >
                        <template v-slot:activator="{ on }">
                        <v-text-field
                            v-model="datefinish"
                            label="fecha de culminacion"
                            prepend-icon="event"
                            readonly
                            v-on="on"
                        ></v-text-field>
                        </template>
                        <v-date-picker v-model="datefinish" :min= "datestart" scrollable>
                        <div class="flex-grow-1"></div>
                        <v-btn text color="primary" @click="modalfinish = false">Cancel</v-btn>
                        <v-btn text color="primary" @click="$refs.dialogfinish.save(datefinish)">OK</v-btn>
                        </v-date-picker>
                    </v-dialog>
                </v-layout>
              <span v-for="(error,index) in errors" :key="index" class="text-danger" >{{ errors }}</span>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-grey"
                class="ma-2 white--text"
                @click="cancelAdd()"
              >
              Cancelar
              </v-btn>
              <v-btn
                color="error"
                class="ma-2 white--text"
                @click="reset()"
                >
                Limpiar
                </v-btn>
                <v-btn
                  :disabled="!validAdd"
                  color="success"
                  text
                  @click="validate()"
                >
                Aceptar
              </v-btn>
            </v-card-actions>
            </v-form>
          </v-card>
        </v-dialog>
    <v-card-title>
      <v-btn
          color="green" 
          icon
          @click="add()"
        >
        <i class="fa fa-plus" style="color:white"></i>
      </v-btn>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Busqueda"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table
      :headers="headers"
      :items="objects"
      :search="search"
    >
      <template v-slot:items="props" >
                <td>
                    <template v-if="props.item.name.length<8">
                        {{ props.item.name }}
                    </template>
                     <template v-else>
                        {{ props.item.name.substring(0,8)+".." }}
                    </template>
                </td>
                <td>{{ props.item.start }}</td>
                <td>{{ props.item.finish }}</td>
                <template v-if="props.item.estatud === 1">
                  <td class="orange--text">En proceso</td>
                </template>
                <template v-else>
                  <td >Finalizado</td>
                </template>
                <td class="text-xs-left">
                <v-flex xs12 >
                    <v-btn
                        color="grey" 
                        icon
                        @click="showGoal(props.item)"
                        >
                        <i class="fa fa-eye" style="color:white"></i>
                    </v-btn>
                    <v-btn
                    color="blue" 
                    icon
                    @click="editGoal(props.item)"
                    >
                    <i href="" class="fa fa-edit" style="color:white"></i>
                    </v-btn>
                    <v-btn
                        color="red" 
                        icon
                        @click="deleteGoal(props.item.id)"
                    >
                    <i href="" class="fa fa-trash" style="color:white"></i>
                    </v-btn>
                    <v-btn
                        color="orange" 
                        icon
                        @click="redirectProject(props.item.id)"
                    >
                    <i class="fa fa-arrow-right" style="color:white"></i>
                    </v-btn>
                </v-flex>
                </td>
          </template>
      <template v-slot:no-results>
        <v-alert :value="true" color="error" icon="warning">
          Tu busqueda de "{{ search }}" no tiene resultado.
        </v-alert>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
  export default {
    props: ['id2'],
    data () {
      return {
          date: '2018-03-02',
        validAdd: true,
        validEdit: true,
        dialogCreate: false,
        dialogEdit: false,
        dialogShow: false,
        dialogDelete: false,
        datestart: new Date().toISOString().substr(0, 10),
        datefinish: new Date().toISOString().substr(0, 10),
        modalstart: false,
        modalfinish: false,
        addName: '',
        addMission: '',
        addVision: '',
        showName: '',
        showCF: '',
        showAF: '',
        editName: '',
        editid: '',
        addItem: {'name': '','datestart': '','datefinish': '','id': ''},
        editItem: {'name': ''},
        deleteId: '',
        search: '',
        connectUser: '',
        objects:[],
        errors: [],
        NameRules: [
        v => !!v || 'Nombre del objectivo es requerido',
        ],
        headers: [
          {
            text: 'Metas',
            align: 'left',
            value: 'name'
          },
          {
            text: 'Fecha de incio',
            align: 'left',
            value: 'start'
          },
          {
            text: 'Fecha de cierre',
            align: 'left',
            value: 'finish'
          },
          {
            text: 'Estatud',
            align: 'left',
            value: 'FA'
          },
          { text: 'Opciones',
            sortable: false,
            value: 'op' 
          },
        ],
      }
    },

    mounted() {
        this.getobjects();
    },

    methods:{
        getobjects(){

            var url= "/api/objects/index/" + this.id2;
            axios.get(url).then(response=>{
                this.objects = response.data;
            });
        },
        validate () {
        if (this.$refs.formAdd.validate()) {
          this.snackbar = true
          this.createObject()
        }
      },

        reset () {
        this.$refs.formAdd.reset()
        },
    //     editGoal(value){
    //       this.dialogEdit = true;
    //       this.errors = [];
    //       this.editName = value.name;
    //       this.editid = value.id;
    //     },
    //     showGoal(value){
    //       this.dialogShow = true;
    //       this.showName = value.name;
    //       this.showCF = value.created_at
    //       this.showAF = value.updated_at
    //     },
        add() {
          this.dialogCreate = true;
          this.errors = [];
        },
    //     deleteGoal(value){
    //       this.dialogDelete = true;
    //       this.deleteId = value;
    //     },
        createObject() {
            this.addItem.name = this.addName;
            this.addItem.datestart = this.datestart;
            this.addItem.datefinish = this.datefinish;
            this.addItem.id = this.id2;
            var url = '/api/object';
            axios.post(url, this.addItem).then(response => {
            this.getobjects();
            this.$refs.formAdd.reset()
            this.dialogCreate = false;
            this.validAdd = true;
            this.errors = [];
            this.$toast.success('Se ah guardado el dato')            
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
    //     destroyGoal() {
    //         var url = '/api/goal/destroy/' + this.deleteId;
    //         axios.delete(url).then(response => {
    //         this.dialogDelete = false;
    //         this.getGoals();
    //           this.$toast.success('Se ah borrado el dato')
    //         }).catch(error => {
    //             this.errors = error.response.data
    //             this.$toast.error('Se origino un error')
    //         });
    //     },
    //     updateGoal() {
    //         this.editItem.name = this.editName;
    //         var url = '/api/goal/update/' + this.editid;
    //         axios.put(url, this.editItem).then(response => {
    //         this.getGoals();
    //         this.dialogEdit = false;
    //         this.errors = [];
    //         this.$toast.success('Se ah actualizada el dato')
    //         }).catch(error => {
    //             this.errors = [];
    //             this.errors = error.response.data
    //             this.$toast.error('Se origino un error')
    //         });
    //     },
    //     redirectProject(value){
    //       var url = '/object/'+ value;
    //       window.location.href = url;
    //     },
        cancelAdd() {
          this.$refs.formAdd.reset()
          this.dialogCreate = false;
        },
    //     cancelUpdateGoal() {
    //        this.dialogEdit = false;
    //     },
    //     cancelShowGoal() {
    //        this.dialogShow = false;
    //     },
    //     cancelDeleteGoal() {
    //        this.dialogDelete = false;
    //     },
    }
  }
</script>