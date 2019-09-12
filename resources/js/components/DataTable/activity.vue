<template>
  <v-card>
    <v-btn
          color="purple" 
          icon
          @click="returnGoal(find)"
        >
        <i class="fas fa-arrow-left" style="color:white"></i>
      </v-btn>
      <v-card-text>
      <v-layout row col>
      <v-text-field
            v-model="viewname"
            label="Meta"
            prepend-icon="fas fa-flag"
            readonly
        ></v-text-field>
      <v-text-field
            v-model="viewpriority"
            label="Prioridad"
            prepend-icon="fas fa-exclamation-circle"
            readonly
        ></v-text-field>
    </v-layout>
      <v-layout row col>
        <template v-if="goal.estatud === 1">
            <v-text-field
            v-model="P"
            label="Estatud"
            prepend-icon="far fa-circle"
            readonly
            ></v-text-field>
        </template>
        <template v-if="goal.estatud === 2">
            <v-text-field
            v-model="F"
            label="Estatud"
            prepend-icon="fas fa-circle"
            readonly
            ></v-text-field>
        </template>
        <template v-if="goal.estatud === 3">
            <v-text-field
            v-model="R"
            label="Estatud"
            prepend-icon="far fa-circle"
            readonly
            ></v-text-field>
        </template>
        <template v-if="goal.estatud === 4">
            <v-text-field
            v-model="E"
            label="Estatud"
            prepend-icon="far fa-circle"
            readonly
            ></v-text-field>
        </template>
        <v-text-field
            v-model="viewCA"
            label="Fecha de creacion de la meta"
            prepend-icon="far fa-calendar-alt"
            prepend-icon-color="blue"
            readonly
      ></v-text-field>
    </v-layout>
  </v-card-text>
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
                    prepend-icon="fas fa-briefcase"
                    v-model="addName"
                    :rules= "NameRules"
                    label="Actividad"
                    required
                ></v-textarea>
                <v-combobox
                  v-model="addPriority"
                  :rules= "PriorityRules"
                  prepend-icon="fas fa-exclamation-circle"
                  :items="Priority"
                  label="Eliga su prioridad"
                  required
                ></v-combobox>
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
                  <v-textarea
                    rows = '2'
                    prepend-icon="far fa-flag"
                    v-model="showName"
                    label="Actividad"
                    readonly
                  ></v-textarea>
                    <v-combobox
                    v-model="showPriority"
                    prepend-icon="fas fa-exclamation-circle"
                    :items="Priority"
                    label="Prioridad"
                    readonly
                  ></v-combobox>
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
                    @click="cancelShowActivity()"
                  >
                  Cancelar
                  </v-btn>
                </v-card-actions>
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
            <v-textarea
                    rows="2"
                    prepend-icon="fas fa-briefcase"
                    v-model="editName"
                    :rules= "NameRules"
                    label="Actividad"
                    required
                ></v-textarea>
                <v-combobox
                  v-model="editPriority"
                  :rules= "PriorityRules"
                  prepend-icon="fas fa-exclamation-circle"
                  :items="Priority"
                  label="Eliga su prioridad"
                  required
                ></v-combobox>
              <span v-for="(error,index) in errors" :key="index" class="text-danger" >{{ errors }}</span>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-grey"
                class="ma-2 white--text"
                @click="cancelUpdateActivity()"
              >
              Cancelar
              </v-btn>
                <v-btn
                  :disabled="!validEdit"
                  color="success"
                  text
                  @click="updateGoal()"
                >
                Aceptar
              </v-btn>
            </v-card-actions>
            </v-form>
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
                    @click="cancelDeleteActivity()"
                >
                cancelar
                </v-btn>
                    <v-form 
                    method="delete"
                    ref="form">
                    <v-btn
                    color="success"
                    text
                    @click="destroyActivity()"
                    >
                    Aceptar
                </v-btn>
                </v-form>
                </v-card-actions>
            </v-card>
            </v-dialog>
            <v-dialog
            width="500"
            v-model="dialogComplete"
            >
            <v-card>
                <v-card-title
                class="headline grey lighten-2"
                primary-title
                >
                    <i class="fas fa-check" style="color:green"></i>
                    &nbsp;
                Confirmación
                </v-card-title>
                <v-card-text>
                ¿Ya completo esta tarea?
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="blue-grey"
                    class="ma-2 white--text"
                    @click="cancelComplete()"
                >
                No
                </v-btn>
                    <v-form 
                    method="delete"
                    ref="form">
                    <v-btn
                    color="success"
                    text
                    @click="completeTask()"
                    >
                    Si
                </v-btn>
                </v-form>
                </v-card-actions>
            </v-card>
            </v-dialog>
  <v-card-title>
    <template v-if="goal.estatud != 2 && goal.estatud != 3">
      <v-btn
          color="green" 
          icon
          @click="add()"
        >
        <i class="fa fa-plus" style="color:white"></i>
      </v-btn>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </template>
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
      :items="activity"
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
                <template v-if="props.item.priority === 'Medio'">
                  <td class="yellow--text">{{ props.item.priority }}</td>
                </template>
                <template v-if="props.item.priority === 'Bajo'">
                  <td class="green--text">{{ props.item.priority }}</td>
                </template>
                <template v-if="props.item.priority === 'Alto'">
                  <td class="red--text">{{ props.item.priority }}</td>
                </template>
                <template v-if="goal.estatud != 2 && goal.estatud != 3">
                    <template v-if="props.item.estatud === 1">
                    <td class="orange--text">En proceso</td>
                    </template>
                </template>
                <template v-else>
                    <template v-if="props.item.estatud === 1">
                    <td class="red--text">No completado</td>
                    </template>
                </template>
                <template v-if="props.item.estatud === 2">
                <td class="green--text">Completado</td>
                </template>
                <td class="text-xs-left">
                <v-flex xs12 >
                    <v-btn
                        color="grey" 
                        icon
                        @click="showActivity(props.item)"
                        >
                        <i class="fa fa-eye" style="color:white"></i>
                    </v-btn>
                    <template v-if="goal.estatud != 2">
                        <template v-if="props.item.estatud != 2">
                            <v-btn
                            color="blue" 
                            icon
                            @click="editActivity(props.item)"
                            >
                            <i href="" class="fa fa-edit" style="color:white"></i>
                            </v-btn>
                            <v-btn
                                color="red" 
                                icon
                                @click="deleteActivity(props.item.id)"
                            >
                            <i href="" class="fa fa-trash" style="color:white"></i>
                            </v-btn>
                            <v-btn
                                color="green" 
                                icon
                                @click="Complete(props.item.id)"
                            >
                            <i class="fas fa-check" style="color:white"></i>
                            </v-btn>
                        </template>
                    </template>
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
    props: ['id','task','find'],
    data () {
      return {
        F: 'Completado',
        P: 'En proceso',
        E: 'En espera',
        R: 'En retrasado',
        viewname: '',
        viewpriority: '',
        viewCA: '',
        goal: [],
        validAdd: true,
        validEdit: true,
        dialogCreate: false,
        dialogEdit: false,
        dialogComplete: false,
        dialogShow: false,
        dialogDelete: false,
        addName: '',
        addPriority: '',
        showName: '',
        showPriority: '',
        showCF: '',
        showAF: '',
        editName: '',
        editPriority: '',
        editid: '',
        addItem: {'name': '','priority': '','id': ''},
        editItem: {'name': '','priority': ''},
        deleteId: '',
        completeId: '',
        search: '',
        connectUser: '',
        activity:[],
        errors: [],
        Priority: [
          'Alto',
          'Medio',
          'Bajo',
        ],
        NameRules: [
        v => !!v || 'Actividad es requerido',
        ],
        PriorityRules: [
        v => !!v || 'Prioridad es requerido',
        ],
        FI: [
        v => !!v || 'Fecha de inicio es requerido',
        ],
        FC: [
        v => !!v || 'Fecha de culminacion es requerido',
        ],
        headers: [
          {
            text: 'Actividades',
            align: 'left',
            value: 'name'
          },
          {
            text: 'Prioridad',
            align: 'left',
            value: 'priority'
          },
          {
            text: 'Estatus',
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
        this.getGoal();
        this.getActivity();
    },

    methods:{

        getGoal () {
          var url= "/api/goal/info/" + this.id;
            axios.get(url).then(response=>{
                this.goal = response.data;
                this.viewname = this.goal.name;
                this.viewpriority = this.goal.priority;
                this.viewquantity = this.goal.quantity;
                this.viewCA = this.goal.created_at;
            });
        },

        getActivity(){

            var url= "/api/activity/index/" + this.id;
            axios.get(url).then(response=>{
                this.activity = response.data;
            });
        },
        validate () {
        if (this.$refs.formAdd.validate()) {
          this.snackbar = true
          this.createActivity()
        }
      },

        reset () {
        this.$refs.formAdd.reset()
        },
        showActivity(value){
          this.dialogShow = true;
          this.showName = value.name;
          this.showPriority = value.priority;
          this.showCF = value.created_at;
          this.showAF = value.updated_at;
        },
        add() {
          this.dialogCreate = true;
          this.errors = [];
        },
        deleteActivity(value){
          this.dialogDelete = true;
          this.deleteId = value;
        },
        createActivity() {
            this.addItem.name = this.addName;
            this.addItem.priority = this.addPriority;
            this.addItem.id = this.id;
            var url = '/api/activity';
            axios.post(url, this.addItem).then(response => {
            this.getActivity();
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
         editActivity(value){
          this.dialogEdit = true;
          this.errors = [];
          this.editName = value.name;
          this.editPriority = value.priority;
          this.editid = value.id;
        },

        updateGoal() {
            this.editItem.name = this.editName;
            this.editItem.priority = this.editPriority;
            var url = '/api/activity/update/' + this.editid;
            axios.put(url, this.editItem).then(response => {
            this.getActivity();
            this.dialogEdit = false;
            this.errors = [];
            this.$toast.success('Se ah actualizada el dato')
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        destroyActivity() {
            var url = '/api/activity/destroy/' + this.deleteId;
            axios.delete(url, this.id).then(response => {
            this.dialogDelete = false;
            this.getActivity();
              this.$toast.success('Se ah borrado el dato')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        completeTask() {
            var url = '/api/activity/complete/' + this.completeId;
            axios.put(url,this.completeId).then(response => {
            this.dialogComplete = false;
            this.getActivity();
              this.$toast.success('Se ah cumplido una actividad')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        returnGoal(value){
          var url = '/goal/'+ value;
          window.location.href = url;
        },
        Complete(value){
            this.dialogComplete = true;
            this.completeId = value;
        },
        cancelAdd() {
          this.$refs.formAdd.reset()
          this.dialogCreate = false;
        },
        cancelShowActivity() {
           this.dialogShow = false;
        },
         cancelUpdateActivity() {
           this.dialogEdit = false;
        },
        cancelDeleteActivity() {
           this.dialogDelete = false;
        },
        cancelComplete() {
           this.dialogComplete = false;
        },
    }
  }
</script>