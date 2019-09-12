<template>
  <v-card>
    <v-dialog
      width="500"
      v-model="dialogAdd"
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
          v-model="addRif"
          label="Rif"
          :rules = "validRif"
          prepend-icon="fas fa-pencil-ruler"
          ></v-text-field>
          <v-text-field
          v-model="addName"
          label="Nombre del la empresa"
          :rules = "validCompanyName"
          prepend-icon="far fa-building"
          ></v-text-field>
          <v-select
            :items="types"
            label="Tipo de empresa"
            name="type"
            :rules = "validType"
            prepend-icon="fas fa-industry"
            v-model="addType"
            item-text="nombre"
            item-value="id"
            ></v-select>
          <v-text-field
          v-model="addCellphone"
          label="Telefono"
          :rules = "validCellphone"
          prepend-icon="fas fa-phone"
          ></v-text-field>
          <v-textarea
          rows="2"
          label="Dirección"
          v-model="addAddress"
          :rules = "validCompanyAddress"
          prepend-icon="far fa-address-book"
          ></v-textarea>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue-grey"
            class="ma-2 white--text"
            @click="cancelCreate()"
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
              &nbsp;
            Visualizar
          </v-card-title>
          <v-card-text>
            <v-text-field
            v-model="showRif"
            label="Rif"
            readonly
            prepend-icon="fas fa-pencil-ruler"
            ></v-text-field>
            <v-text-field
            v-model="showName"
            label="Nombre del la empresa"
            readonly
            prepend-icon="far fa-building"
            ></v-text-field>
            <v-text-field
            v-model="showType"
            label="Tipo de empresa"
            readonly
            prepend-icon="fas fa-industry"
            ></v-text-field>
            <v-text-field
            v-model="showCellphone"
            label="Telefono"
            readonly
            prepend-icon="fas fa-phone"
            ></v-text-field>
            <v-textarea
            rows="2"
            label="Dirección"
            v-model="showAddress"
            prepend-icon="far fa-address-book"
            ></v-textarea>
            <v-layout row col>
            <v-text-field
            v-model="showCF"
            label="Creado en la fecha:"
            readonly
            prepend-icon="far fa-calendar-alt"
            ></v-text-field>
            <v-text-field
            v-model="showAF"
            label="Actualizado en la fecha:"
            readonly
            prepend-icon="fa fa-calendar-alt"
            ></v-text-field>
            </v-layout>
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue-grey"
              class="ma-2 white--text"
              @click="cancelShow()"
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
                  v-model="validEdit"
                  lazy-validation
                  >
            <v-card-text>
              <v-text-field
              v-model="editRif"
              label="Rif"
              :rules = "validRif"
              prepend-icon="fas fa-pencil-ruler"
              ></v-text-field>
              <v-text-field
              v-model="editName"
              label="Nombre del la empresa"
              :rules = "validCompanyName"
              prepend-icon="far fa-building"
              ></v-text-field>
              <v-select 
                v-if="this.editType != 1"
                :items="types"
                label="Tipo de empresa"
                name="type"
                prepend-icon="fas fa-industry"
                v-model="editType"
                item-text="nombre"
                item-value="id"
                ></v-select>
                <v-select
                v-if="this.editType == 1"
                :items="typeAmd"
                label="Tipo de empresa"
                name="type"
                prepend-icon="fas fa-industry"
                v-model="editType"
                item-text="nombre"
                item-value="id"
                readonly
                ></v-select>
              <v-text-field
              v-model="editCellphone"
              label="Telefono"
              :rules = "validCellphone"
              prepend-icon="fas fa-phone"
              ></v-text-field>
              <v-textarea
              rows="2"
              label="Dirección"
              v-model="editAddress"
              :rules = "validCompanyAddress"
              prepend-icon="far fa-address-book"
              ></v-textarea>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="blue-grey"
                class="ma-2 white--text"
                @click="cancelUpdate()"
              >
              Cancelar
              </v-btn>

                <v-btn
                  :disabled="!validEdit"
                  color="success"
                  text
                  @click="updateCompany()"
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
                ¿Usted desea deshabilitarlo?
              </v-card-text>
              <v-divider></v-divider>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue-grey"
                  class="ma-2 white--text"
                  @click="cancelDelete()"
                >
                cancelar
                </v-btn>
                
                  <v-form 
                    method="put"
                    ref="form">
                  <v-btn
                    color="success"
                    text
                    @click="destroyCompany()"
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
          @click="addCompany()"
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
      :items="companies"
      :search="search"
    >
      <template v-slot:items="props">
        <td>{{ props.item.nombre }}</td>
        <td>{{ props.item.rif }}</td>
        <td>{{ props.item.type.nombre }}</td>
        <td>{{ props.item.telefono }}</td>
        <td class="text-xs-left">
           <v-flex xs12 >
             <v-btn
            color="grey" 
            icon
            @click="showCompany(props.item)"
            >
            <i class="fa fa-eye" style="color:white"></i>
          </v-btn>
            <v-btn
              color="blue" 
              icon
              @click="editCompany(props.item)"
            >
            <i href="" class="fa fa-edit" style="color:white"></i>
            </v-btn>
            <v-btn 
                v-if="props.item.id != 1"
                color="red" 
                icon
                @click="deleteCompany(props.item.id)"
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
        validEdit: true,
        validAdd: true,
        dialogAdd: false,
        dialogShow: false,
        dialogEdit: false,
        dialogDelete: false,
        types: [],
        addRif: '',
        addName: '',
        addType: '',
        addCellphone: '',
        addAddress: '',
        showRif: '',
        showName: '',
        showType: '',
        showCellphone: '',
        showAddress: '',
        showCF: '',
        showAF: '',
        editRif: '',
        editName: '',
        editType: '',
        editCellphone: '',
        editAddress: '',
        editid: '',
        addItemCompany: {'name': '','rif': '','type': '','cellphone': '','address': ''},
        editItemCompany: {'name': '','rif': '','type': '','cellphone': '','address': ''},
        search: '',
        deleteCompanie: '',
        companies:[],
        typeAmd:[],
        validRif: [
        v => !!v || 'Rif es requerido',
        ],
        validCompanyAddress: [
          v => !!v || 'Dirección es requerido',
        ],
        validType: [
          v => !!v || 'Tipo de empresa es requerido',
        ],
        validCompanyName: [
          v => !!v || 'Nombre es requerido',
        ],
        validCellphone: [
          v => !!v || 'Telefono es requerido',
        ],
        headers: [
          {
            text: 'Nombre de empresa',
            align: 'left',
            value: 'nombre'
          },
          {
            text: 'Rif',
            align: 'left',
            value: 'identificacion'
          },
          {
            text: 'Tipo',
            align: 'left',
            value: 'type'
          },
          {
            text: 'Telefono',
            align: 'left',
            value: 'telefono'
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
      this.getCompany();
      this.getTypeAdm();
    },

    methods:{

        getCompany(){
            var urlCompanies= "api/company/index";
            axios.get(urlCompanies).then(response=>{
                this.companies = response.data
            });
        },
        getTypes(){
            var urlTypes= "api/type/index";
            axios.get(urlTypes).then(response=>{
                this.types = response.data
            });
        },
        getTypeAdm(){
            var url= "api/type/index/adm";
            axios.get(url).then(response=>{
                this.typeAmd = response.data;
            });
        },
        validate () {
          if (this.$refs.formAdd.validate()) {
            this.snackbar = true
            this.createCompany()
          }
        },
        addCompany(){
          this.dialogAdd = true;
          this.errors = [];
        },

        reset () {
        this.$refs.formAdd.reset()
        },

        showCompany(value){
          this.dialogShow = true;
          this.errors = [];
          this.showRif = value.rif;
          this.showName = value.nombre;
          this.showType = value.type.nombre;
          this.showAddress = value.direccion;
          this.showCellphone = value.telefono;
          this.showCF = value.created_at
          this.showAF = value.updated_at
        },
        editCompany(value){
          this.dialogEdit = true;
          this.errors = [];
          this.editRif = value.rif;
          this.editName = value.nombre;
          this.editType = value.type_id;
          this.editCellphone = value.telefono;
          this.editAddress = value.direccion;
          this.editid = value.id;
        },
        deleteCompany(value){
          this.dialogDelete = true;
          this.deleteCompanie = value;
        },
        createCompany() {
            this.addItemCompany.rif = this.addRif;
            this.addItemCompany.name = this.addName;
            this.addItemCompany.type = this.addType;
            this.addItemCompany.cellphone = this.addCellphone;
            this.addItemCompany.address = this.addAddress;
            var url = 'api/company';
            axios.post(url, this.addItemCompany).then(response => {
              this.getCompany();
              this.getTypes();
              this.dialogAdd = false;
              this.$refs.formAdd.reset()
              this.errors = [];
              this.$toast.success('Se ah actualizada el dato')
            }).catch(error => {
              this.errors = [];
              this.errors = error.response.data
              this.$toast.error('Se origino un error')
            });
        },
        updateCompany() {
            this.editItemCompany.rif = this.editRif;
            this.editItemCompany.name = this.editName;
            this.editItemCompany.type = this.editType;
            this.editItemCompany.cellphone = this.editCellphone;
            this.editItemCompany.address = this.editAddress;
            var url = 'api/company/update/' + this.editid;
            axios.put(url, this.editItemCompany).then(response => {
              this.getCompany();
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
        destroyCompany(){
            var url = 'api/company/destroy/' + this.deleteCompanie;
            axios.put(url).then(response => {
              this.dialogDelete = false;
              this.getCompany();
              this.getTypes();
              this.$toast.success('Se ah borrado el dato')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        cancelCreate() {
           this.dialogAdd = false;
           this.$refs.formAdd.reset()
        },
        cancelUpdate() {
           this.dialogEdit = false;
        },
        cancelShow() {
           this.dialogShow = false;
        },
        cancelDelete() {
           this.dialogDelete = false;
        },
    }
  }
</script>