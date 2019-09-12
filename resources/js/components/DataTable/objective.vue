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
                <v-text-field
                    prepend-icon="far fa-flag"
                    v-model="addName"
                    :rules= "NameRules"
                    label="Nombre del objetivo"
                    required
                ></v-text-field>
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
        <v-dialog
          width="500"
          v-model="dialogEdit"
        >
          <v-card>
            <v-card-title
              class="headline grey lighten-2"
              primary-title
            >
              <i class="fa fa-edit" style="color:blue"></i>
                &nbsp;
              Editar
            </v-card-title>
              <v-form 
                  method="put"
                  ref="form"
                  v-model="validEdit"
                  lazy-validation
                  >
            <v-card-text>
             <v-text-field
                    prepend-icon="far fa-flag"
                    v-model="editName"
                    :rules= "NameRules"
                    label="Nombre del objetivo"
                    required
                ></v-text-field>
              <span v-for="(error,index) in errors" :key="index" class="text-danger" >{{ errors }}</span>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-grey"
                class="ma-2 white--text"
                @click="cancelUpdateObjective()"
              >
              Cancelar
              </v-btn>
                <v-btn
                  :disabled="!validEdit"
                  color="success"
                  text
                  @click="updateObjective()"
                >
                Aceptar
              </v-btn>
            </v-card-actions>
            </v-form>
          </v-card>
        </v-dialog>
        <v-dialog
              width="500"
              v-model="dialogShow"
            >
              <v-card>
                <v-card-title
                  class="headline grey lighten-2"
                  primary-title
                >
                  <i class="fa fa-eye" style="color:grey"></i>
                  &nbsp; Visualizar
                </v-card-title>
                <v-card-text>
                  <v-text-field
                    prepend-icon="far fa-flag"
                    v-model="showName"
                    label="Nombre del objetivo"
                    readonly
                  ></v-text-field>
                    <v-layout row col>
                    <v-text-field
                    v-model="showCF"
                    label="Creado en la fecha:"
                    prepend-icon="far fa-calendar-alt"
                    readonly
                    ></v-text-field>
                    <v-text-field
                    v-model="showAF"
                    label="Actualizado en la fecha:"
                    prepend-icon="fa fa-calendar-alt"
                    readonly
                    ></v-text-field>
                    </v-layout>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="blue-grey"
                    class="ma-2 white--text"
                    @click="cancelShowObjective()"
                  >
                  Cancelar
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
            <v-dialog
                width="500"
                v-model="dialogDelete"
              >
                <v-card>
                  <v-card-title
                    class="headline grey lighten-2"
                    primary-title
                  >
                     <i class="fa fa-trash" style="color:red"></i>
                     &nbsp;
                    Confirmación
                  </v-card-title>
                  <v-card-text>
                    ¿Usted desea eliminar?
                  </v-card-text>
                  <v-divider></v-divider>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                      color="blue-grey"
                      class="ma-2 white--text"
                      @click="cancelDeleteObjective()"
                    >
                    cancelar
                    </v-btn>
                      <v-form 
                        method="delete"
                        ref="form">
                      <v-btn
                        color="success"
                        text
                        @click="destroyObjective()"
                      >
                      Aceptar
                    </v-btn>
                  </v-form>
                  </v-card-actions>
                </v-card>
              </v-dialog>
    <v-card-title>
      <v-btn
          color="green" 
          icon
          @click="addObjective()"
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
      :items="objective"
      :search="search"
    >
      <template v-slot:items="props" >
                <td>{{ props.item.name }}</td>
                <td>{{ props.item.quantity }}</td>
                <template v-if="props.item.estatud === 1">
                  <td class="orange--text">En proceso</td>
                </template>
                <template v-else>
                  <td class="green--text">Completado</td>
                </template>
                <td class="text-xs-left">
                <v-flex xs12 >
                    <v-btn
                        color="grey" 
                        icon
                        @click="showObjective(props.item)"
                        >
                        <i class="fa fa-eye" style="color:white"></i>
                    </v-btn>
                    <v-btn
                    color="blue" 
                    icon
                    @click="editObjective(props.item)"
                    >
                    <i href="" class="fa fa-edit" style="color:white"></i>
                    </v-btn>
                    <v-btn
                        color="red" 
                        icon
                        @click="deleteObjective(props.item.id)"
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
        validAdd: true,
        validEdit: true,
        dialogCreate: false,
        dialogEdit: false,
        dialogShow: false,
        dialogDelete: false,
        addName: '',
        addMission: '',
        addVision: '',
        showName: '',
        showCF: '',
        showAF: '',
        editName: '',
        editid: '',
        addItem: {'name': '','id': ''},
        editItem: {'name': ''},
        deleteId: '',
        search: '',
        connectUser: '',
        objective:[],
        errors: [],
        NameRules: [
        v => !!v || 'Nombre del objetivo es requerido',
        ],
        headers: [
          {
            text: 'Objetivo',
            align: 'left',
            value: 'name'
          },
          {
            text: 'Cantidad de metas',
            align: 'left',
            value: 'quantity'
          },
          {
            text: 'Estatus',
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
        this.getObjective();
    },

    methods:{
        getObjective(){

            var url= "/api/objective/index/" + this.id2;
            axios.get(url).then(response=>{
                this.objective = response.data;
            });
        },
        validate () {
        if (this.$refs.formAdd.validate()) {
          this.snackbar = true
          this.createObjective()
        }
      },

        reset () {
        this.$refs.formAdd.reset()
        },
        editObjective(value){
          this.dialogEdit = true;
          this.errors = [];
          this.editName = value.name;
          this.editid = value.id;
        },
        showObjective(value){
          this.dialogShow = true;
          this.showName = value.name;
          this.showCF = value.created_at
          this.showAF = value.updated_at
        },
        addObjective() {
          this.dialogCreate = true;
          this.errors = [];
        },
        deleteObjective(value){
          this.dialogDelete = true;
          this.deleteId = value;
        },
        createObjective() {
            this.addItem.name = this.addName;
            this.addItem.id = this.id2;
            var url = '/api/objective';
            axios.post(url, this.addItem).then(response => {
            this.getObjective();
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
        destroyObjective() {
            var url = '/api/objective/destroy/' + this.deleteId;
            axios.delete(url).then(response => {
            this.dialogDelete = false;
            this.getObjective();
              this.$toast.success('Se ah borrado el dato')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        updateObjective() {
            this.editItem.name = this.editName;
            var url = '/api/objective/update/' + this.editid;
            axios.put(url, this.editItem).then(response => {
            this.getObjective();
            this.dialogEdit = false;
            this.errors = [];
            this.$toast.success('Se ah actualizada el dato')
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        redirectProject(value){
          var url = '/goal/'+ value;
          window.location.href = url;
        },
        cancelAdd() {
          this.$refs.formAdd.reset()
          this.dialogCreate = false;
        },
        cancelUpdateObjective() {
           this.dialogEdit = false;
        },
        cancelShowObjective() {
           this.dialogShow = false;
        },
        cancelDeleteObjective() {
           this.dialogDelete = false;
        },
    }
  }
</script>