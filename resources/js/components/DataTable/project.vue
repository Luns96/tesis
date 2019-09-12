<template>
  
  <v-card>
    <v-dialog
          width="1200"
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
                    prepend-icon="fas fa-network-wired"
                    v-model="addName"
                    :rules= "NameRules"
                    label="Nombre del proyecto"
                    required
                ></v-text-field>
                <v-layout row col>
                    <v-textarea
                    rows="2"
                        label="Mision"
                        v-model="addMission"
                        :rules = "MissionRules"
                        prepend-icon="far fa-comment-alt"
                    ></v-textarea>
                    <v-textarea
                        rows="2"
                        label="Vision"
                        v-model="addVision"
                        :rules = "VisionRules"
                        prepend-icon="fas fa-comment-alt"
                    ></v-textarea>
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
    <v-dialog
          width="1200"
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
                    prepend-icon="fas fa-network-wired"
                    v-model="editName"
                    :rules= "NameRules"
                    label="Nombre del proyecto"
                    required
                ></v-text-field>
                <v-layout row col>
                    <v-textarea
                    rows="2"
                        label="Mision"
                        v-model="editMission"
                        :rules = "MissionRules"
                        prepend-icon="far fa-comment-alt"
                    ></v-textarea>
                    <v-textarea
                        rows="2"
                        label="Vision"
                        v-model="editVision"
                        :rules = "VisionRules"
                        prepend-icon="fas fa-comment-alt"
                    ></v-textarea>
                </v-layout>
              <span v-for="(error,index) in errors" :key="index" class="text-danger" >{{ errors }}</span>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-grey"
                class="ma-2 white--text"
                @click="cancelUpdateProject()"
              >
              Cancelar
              </v-btn>
                <v-btn
                  :disabled="!validEdit"
                  color="success"
                  text
                  @click="updateProject()"
                >
                Aceptar
              </v-btn>
            </v-card-actions>
            </v-form>
          </v-card>
        </v-dialog>
        <v-dialog
              width="1200"
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
                    prepend-icon="fas fa-network-wired"
                    v-model="showName"
                    label="Nombre del proyecto"
                    readonly
                  ></v-text-field>
                  <v-layout row col>
                      <v-textarea
                      rows="2"
                          label="Mision"
                          v-model="showMission"
                          prepend-icon="far fa-comment-alt"
                          readonly
                      ></v-textarea>
                      <v-textarea
                          rows="2"
                          label="Vision"
                          v-model="showVision"
                          prepend-icon="fas fa-comment-alt"
                          readonly
                    ></v-textarea>
                  </v-layout>
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
                    @click="cancelShowProject()"
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
                      @click="cancelDeleteProject()"
                    >
                    cancelar
                    </v-btn>
                      <v-form 
                        method="delete"
                        ref="form">
                      <v-btn
                        color="success"
                        text
                        @click="destroyProject()"
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
          @click="addProject()"
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
      :items="projects"
      :search="search"
    >
      <template v-slot:items="props" >
                <td>{{ props.item.name }}</td>
                <td>{{ props.item.created_at }}</td>
                <template v-if="props.item.estatud === 1">
                  <td  class="orange--text">En proceso</td>
                </template>
                <template v-else>
                  <td  class="green--text">Finalizado</td>
                </template>
                <td class="text-xs-left">
                <v-flex xs12 >
                    <v-btn
                        color="grey" 
                        icon
                        @click="showProject(props.item)"
                        >
                        <i class="fa fa-eye" style="color:white"></i>
                    </v-btn>
                    <v-btn
                    color="blue" 
                    icon
                    @click="editProject(props.item)"
                    >
                    <i href="" class="fa fa-edit" style="color:white"></i>
                    </v-btn>
                    <v-btn
                        color="red" 
                        icon
                        @click="deleteProject(props.item.id)"
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
        showMission: '',
        showVision: '',
        showCF: '',
        showAF: '',
        editName: '',
        editMission: '',
        editVision: '',
        editid: '',
        addItem: {'name': '','mission': '','vision': '','id': ''},
        editItem: {'name': '','mission': '','vision': ''},
        deleteId: '',
        search: '',
        connectUser: '',
        projects:[],
        errors: [],
        id: 'project/goals/1',
        NameRules: [
        v => !!v || 'Nombre del proyecto es requerido',
        ],
        MissionRules: [
        v => !!v || 'La mision es requerido',
        ],
        VisionRules: [
        v => !!v || 'La vision es requerido',
        ],
        headers: [
          {
            text: 'Nombre del proyecto',
            align: 'left',
            value: 'name'
          },
          {
            text: 'Fecha de creacion',
            align: 'left',
            value: 'FC'
          },
          {
            text: 'Estatud del proyecto',
            align: 'left',
            value: 'estatud'
          },
          { text: 'Opciones',
            sortable: false,
            value: 'op' 
          },
        ],
      }
    },

    mounted() {
        this.getid();
        this.getProjects();
    },

    methods:{
        getProjects(){
            var url= "project/index";
            axios.get(url).then(response=>{
                this.projects = response.data;
            });
        },
        validate () {
        if (this.$refs.formAdd.validate()) {
          this.snackbar = true
          this.createProject()
        }
      },
        getid(){
            var url= "user/account";
            axios.get(url).then(response=>{
                this.connectUser = response.data;
            });
        },

        reset () {
        this.$refs.formAdd.reset()
        },
        editProject(value){
          this.dialogEdit = true;
          this.errors = [];
          this.editName = value.name;
          this.editMission = value.mission;
          this.editVision = value.vision;
          this.editid = value.id;
        },
        showProject(value){
          this.dialogShow = true;
          this.showName = value.name;
          this.showMission = value.mission;
          this.showVision = value.vision;
          this.showCF = value.created_at
          this.showAF = value.updated_at
        },
        deleteProject(value){
          this.dialogDelete = true;
          this.deleteId = value;
        },
        addProject() {
          this.dialogCreate = true;
          this.errors = [];
        },
        createProject() {
            this.addItem.name = this.addName;
            this.addItem.mission = this.addMission;
            this.addItem.vision = this.addVision;
            this.addItem.id = this.connectUser.id;
            var url = 'api/project';
            axios.post(url, this.addItem).then(response => {
            this.getProjects();
            this.$refs.formAdd.reset()
            this.dialogCreate = false;
            this.$refs.formAdd.reset()
            this.validAdd = true;
            this.errors = [];
            this.$toast.success('Se ah guardado el dato')            
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        destroyProject() {
            var url = 'api/project/destroy/' + this.deleteId;
            axios.delete(url).then(response => {
            this.dialogDelete = false;
            this.getProjects();
              this.$toast.success('Se ah borrado el dato')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        updateProject() {
            this.editItem.name = this.editName;
            this.editItem.mission = this.editMission;
            this.editItem.vision = this.editVision;
            var url = 'api/project/update/' + this.editid;
            axios.put(url, this.editItem).then(response => {
            this.getProjects();
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
          var url = 'objective/'+ value;
          window.location.href = url;
        },
        cancelAdd() {
          this.$refs.formAdd.reset()
          this.dialogCreate = false;
        },
        cancelUpdateProject() {
           this.dialogEdit = false;
        },
        cancelShowProject() {
           this.dialogShow = false;
        },
        cancelDeleteProject() {
           this.dialogDelete = false;
        },
    }
  }
</script>