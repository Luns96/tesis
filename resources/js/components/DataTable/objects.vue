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
            label="Objetivo de la meta"
            prepend-icon="far fa-flag"
            readonly
        ></v-text-field>
      <v-text-field
            v-model="viewquantity"
            label="Cantida de los objetivos"
            prepend-icon="fas fa-sort-numeric-up"
            readonly
        ></v-text-field>
         <v-text-field
            v-model="task"
            label="Objetivos completo"
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
                    prepend-icon="fas fa-flag"
                    v-model="addName"
                    :rules= "NameRules"
                    label="objectivo"
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
                            :rules= "FI"
                            readonly
                            v-on="on"
                        ></v-text-field>
                        </template>
                        <v-date-picker v-model="datestart" :max= "datefinish" scrollable>
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
                            :rules= "FC"
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
                    label="Objectivo"
                    readonly
                  ></v-textarea>
                    <v-combobox
                    v-model="showPriority"
                    prepend-icon="fas fa-exclamation-circle"
                    :items="Priority"
                    label="Eliga su prioridad"
                    readonly
                  ></v-combobox>
                    <v-layout row col>
                    <v-text-field
                    v-model="showDS"
                    label="Fecha de inicio:"
                    prepend-icon="event"
                    readonly
                    ></v-text-field>
                    <v-text-field
                    v-model="showDF"
                    label="Fecha de culminacion:"
                    prepend-icon="event"
                    readonly
                    ></v-text-field>
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
                    @click="cancelShowObject()"
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
                    @click="cancelDeleteObject()"
                >
                cancelar
                </v-btn>
                    <v-form 
                    method="delete"
                    ref="form">
                    <v-btn
                    color="success"
                    text
                    @click="destroyObject()"
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
                <template v-if="props.item.priority === 'Medio'">
                  <td class="yellow--text">{{ props.item.priority }}</td>
                </template>
                <template v-if="props.item.priority === 'Bajo'">
                  <td class="green--text">{{ props.item.priority }}</td>
                </template>
                <template v-if="props.item.priority === 'Alto'">
                  <td class="red--text">{{ props.item.priority }}</td>
                </template>
                <td>{{ props.item.start }}</td>
                <td>{{ props.item.finish }}</td>
                <template v-if="props.item.estatud === 1">
                  <td class="orange--text">En proceso</td>
                </template>
                <template v-if="props.item.estatud === 2">
                  <td class="green--text">Completado</td>
                </template>
                <template v-if="props.item.estatud === 3">
                  <td class="red--text">Retrasado</td>
                </template>
                <template v-if="props.item.estatud === 4">
                  <td class="grey--text">En espera</td>
                </template>
                <td class="text-xs-left">
                <v-flex xs12 >
                    <v-btn
                        color="grey" 
                        icon
                        @click="showObject(props.item)"
                        >
                        <i class="fa fa-eye" style="color:white"></i>
                    </v-btn>
                    <template v-if="props.item.estatud != 2">
                      <template v-if="props.item.estatud != 3">
                        <v-btn
                            color="red" 
                            icon
                            @click="deleteObject(props.item.id)"
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
                      <template v-if="props.item.estatud === 3">
                        <v-btn
                            color="white" 
                            icon
                        >
                        <i class="fas fa-check" style="color:white"></i>
                        </v-btn>
                      </template>
                    </template>
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
    props: ['id','task','find'],
    data () {
      return {
        F: 'Completado',
        P: 'En proceso',
        viewname: '',
        viewquantity: '',
        viewCA: '',
        goal: [],
        validAdd: true,
        validEdit: true,
        dialogCreate: false,
        dialogComplete: false,
        dialogShow: false,
        dialogDelete: false,
        datestart: '',
        datefinish: '',
        modalstart: false,
        modalfinish: false,
        addName: '',
        addPriority: '',
        showName: '',
        showPriority: '',
        showDS: '',
        showDF: '',
        showCF: '',
        showAF: '',
        editName: '',
        editid: '',
        addItem: {'name': '','datestart': '','datefinish': '','priority': '','id': ''},
        editItem: {'name': ''},
        deleteId: '',
        completeId: '',
        search: '',
        connectUser: '',
        objects:[],
        errors: [],
        Priority: [
          'Alto',
          'Medio',
          'Bajo',
        ],
        NameRules: [
        v => !!v || 'Nombre del objectivo es requerido',
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
            text: 'Objetivos',
            align: 'left',
            value: 'name'
          },
          {
            text: 'Prioridad',
            align: 'left',
            value: 'priority'
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
        this.getobjects();
    },

    methods:{

        getGoal () {
          var url= "/api/goals/info/" + this.id;
            axios.get(url).then(response=>{
                this.goal = response.data;
                this.viewname = this.goal.name;
                this.viewquantity = this.goal.quantity;
                this.viewCA = this.goal.created_at;
            });
        },

        getobjects(){

            var url= "/api/objects/index/" + this.id;
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
        showObject(value){
          this.dialogShow = true;
          this.showName = value.name;
          this.showPriority = value.priority;
          this.showDS = value.start;
          this.showDF = value.finish;
          this.showCF = value.created_at;
          this.showAF = value.updated_at;
        },
        add() {
          this.dialogCreate = true;
          this.errors = [];
        },
        deleteObject(value){
          this.dialogDelete = true;
          this.deleteId = value;
        },
        createObject() {
            this.addItem.name = this.addName;
            this.addItem.datestart = this.datestart;
            this.addItem.datefinish = this.datefinish;
            this.addItem.priority = this.addPriority;
            this.addItem.id = this.id;
            var url = '/api/object';
            axios.post(url, this.addItem).then(response => {
            this.getobjects();
            this.getGoal();
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
        destroyObject() {
            var url = '/api/object/destroy/' + this.deleteId;
            axios.delete(url, this.id).then(response => {
            this.dialogDelete = false;
            this.getobjects();
            this.getGoal();
              this.$toast.success('Se ah borrado el dato')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        completeTask() {
            var url = '/api/object/update/' + this.completeId;
            axios.put(url,this.completeId).then(response => {
            this.dialogComplete = false;
            this.getobjects();
            this.getGoal();
              this.$toast.success('Se ah cumplido un objetivo')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        redirectProject(value){
          var url = '/activity/'+ value;
          window.location.href = url;
        },
        returnGoal(value){
          var url = '/goals/'+ value;
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
        cancelShowObject() {
           this.dialogShow = false;
        },
        cancelDeleteObject() {
           this.dialogDelete = false;
        },
        cancelComplete() {
           this.dialogComplete = false;
        },
    }
  }
</script>