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
              name='addType'
              prepend-icon="fa fa-industry"
              v-model="addNameTypes"
              :rules="addTypeRules"
              label="Tipo de empresa"
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
                @click="cancelAddType()"
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
              name='editType'
              prepend-icon="fa fa-industry"
              v-model="editNameTypes"
              :rules="editTypeRules"
              label="Tipo de empresa"
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
                @click="cancelUpdateType()"
              >
              Cancelar
              </v-btn>
                <v-btn
                  :disabled="!validEdit"
                  color="success"
                  text
                  @click="updateType()"
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
                  v-model="showNameTypes"
                  label="Tipo de empresa"
                  prepend-icon="fa fa-industry"
                  readonly
                  ></v-text-field>
                    <v-layout row col>
                    <v-text-field
                    v-model="showCFType"
                    label="Creado en la fecha:"
                    prepend-icon="far fa-calendar-alt"
                    readonly
                    ></v-text-field>
                    <v-text-field
                    v-model="showAFType"
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
                    @click="cancelShowType()"
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
                    ¿Usted desea deshabilitarlo?
                  </v-card-text>
                  <v-divider></v-divider>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                      color="blue-grey"
                      class="ma-2 white--text"
                      @click="cancelDeleteType()"
                    >
                    cancelar
                    </v-btn>
                      <v-form 
                        method="put"
                        ref="form">
                      <v-btn
                        v-model= "deleteTypes"
                        color="success"
                        text
                        @click="destroyType()"
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
          @click="addType()"
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
      :items="types"
      :search="search"
    >
      <template v-slot:items="props">
        <td>{{ props.item.nombre }}</td>
        <td class="text-xs-left">
           <v-flex xs12 >
             <v-btn
                  color="grey" 
                  icon
                  @click="showType(props.item)"
                >
                <i class="fa fa-eye" style="color:white"></i>
              </v-btn>
             <v-btn
              color="blue" 
              icon
              @click="editType(props.item)"
            >
            <i href="" class="fa fa-edit" style="color:white"></i>
            </v-btn>
            <v-btn
                v-if="props.item.id != 1"
                color="red" 
                icon
                @click="deleteType(props.item.id)"
              >
              <i href="" class="fa fa-trash" style="color:white"></i>
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
        addNameTypes: '',
        showNameTypes: '',
        showCFType: '',
        showAFType: '',
        editTypes: '',
        editIdTypes: '',
        editNameTypes: '',
        editItemTypes: {'name': ''},
        addItemTypes: {'name': ''},
        deleteIdTypes: '',
        search: '',
        deleteTypes: '',
        types:[],
        errors: [],
        addTypeRules: [
        v => !!v || 'Tipo es requerido',
        ],
        editTypeRules: [
        v => !!v || 'Tipo es requerido',
        ],
        headers: [
          {
            text: 'Tipo de empresa',
            align: 'left',
            value: 'nombre'
          },
          { text: 'Opciones',
            sortable: false,
            value: 'op' 
          },
        ],
      }
    },

    mounted() {
        this.getTypes();
    },

    methods:{
        getTypes(){
            var urlTypes= "api/type/index";
            axios.get(urlTypes).then(response=>{
                this.types = response.data
            });
        },
        validate () {
        if (this.$refs.formAdd.validate()) {
          this.snackbar = true
          this.createType()
        }
      },

        reset () {
        this.$refs.formAdd.reset()
        },
        editType(value){
          this.dialogEdit = true;
          this.errors = [];
          this.editNameTypes = value.nombre;
          this.editIdTypes = value.id
        },
        showType(value){
          this.dialogShow = true;
          this.showNameTypes = value.nombre;
          this.showCFType = value.created_at
          this.showAFType = value.updated_at
        },
        deleteType(value){
          this.dialogDelete = true;
          this.deleteIdTypes = value;
        },
        addType() {
          this.dialogCreate = true;
          this.errors = [];
        },
        addResetType() {
          this.addNameTypes = '';
          this.validAdd = true;
        },
        createType() {
            this.addItemTypes.name = this.addNameTypes;
            var url = 'api/type';
            axios.post(url, this.addItemTypes).then(response => {
            this.getTypes();
            this.$refs.formAdd.reset()
            this.dialogCreate = false;
            this.addNameTypes = '';
            this.validAdd = true;
            this.errors = [];
            this.$toast.success('Se ah guardado el dato')            
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        destroyType() {
            var url = 'api/type/destroy/' + this.deleteIdTypes;
            axios.put(url).then(response => {
            this.dialogDelete = false;
            this.getTypes();
              this.$toast.success('Se ah borrado el dato')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        updateType() {
            this.editItemTypes.name = this.editNameTypes;
            var url = 'api/type/update/' + this.editIdTypes;
            axios.put(url, this.editItemTypes).then(response => {
            this.getTypes();
            this.dialogEdit = false;
            this.errors = [];
            this.$toast.success('Se ah actualizada el dato')
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        cancelAddType() {
          this.$refs.formAdd.reset()
          this.dialogCreate = false;
        },
        cancelUpdateType() {
           this.dialogEdit = false;
        },
        cancelShowType() {
           this.dialogShow = false;
        },
        cancelDeleteType() {
           this.dialogDelete = false;
        },
    }
  }
</script>