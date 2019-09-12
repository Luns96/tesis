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
              name='user'
              v-model="newUser"
              :rules="validUser"
              label="Nombre"
              prepend-icon="fas fa-user"
              required
            ></v-text-field>
            <v-text-field
              name='surname'
              v-model="newSurname"
              :rules="validSurname"
              label="Apellido"
              prepend-icon="fas fa-user-friends"
              required
            ></v-text-field>
            <v-text-field
            name='CI'
            v-model="newCI"
            :rules="validCI"
            prepend-icon="fas fa-address-card"
            label="Cedula de identidad"
            required
            ></v-text-field>
            <v-text-field
            v-model="newEmail"
            :rules="validEmail"
            label="E-mail"
            prepend-icon="fas fa-envelope"
            required
            ></v-text-field>
            <v-text-field
            v-model="newPassword"
            :rules="validPassword"
            label="Contraseña"
            type="password"
            prepend-icon="fas fa-key"
            required
            ></v-text-field>
            <v-select
            :items="companies"
            label="Selecciona la empresa"
            name="company"
            prepend-icon="far fa-building"
            :rules="validCompany"
            :disabled="!addCompanySelect"
            v-model="newCompany"
            item-text="nombre"
            item-value="id"
            ></v-select>
            <v-text-field
              name='Cellnumber'
              v-model="newCellnumber"
              :rules="validCellnumber"
              label="Numero telefonico"
              prepend-icon="fas fa-phone"
              required
          ></v-text-field>
            <v-select
            :items="roles"
            label="Selecciona un rol"
            name="rol"
            prepend-icon="fas fa-users"
            :rules="validRol"
            v-model="newRol"
            item-text="name"
            @change="rolesChange(newRol)"
            ></v-select>
            <span v-for="(error,index) in errors" :key="index" class="text-danger" >{{ errors }}</span>
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
              &nbsp; Visualizar
          </v-card-title>
          <v-card-text>
            <v-text-field
              v-model="showName"
              label="Nombre"
              prepend-icon="fas fa-user"
              readonly
            ></v-text-field>
            <v-text-field
              v-model="showSurname"
              label="Apellido"
              prepend-icon="fas fa-user-friends"
              readonly
            ></v-text-field>
                <v-text-field
                v-model="showCI"
                prepend-icon="fas fa-address-card"
                label="Cedula de identidad"
                readonly
                ></v-text-field>
            <v-text-field
            v-model="showEmail"
            label="E-mail"
            prepend-icon="fas fa-envelope"
            readonly
            ></v-text-field>
            <v-text-field
            v-model="showCompany"
            label="Selecciona la empresa"
            prepend-icon="fas fa-building"
            readonly
            ></v-text-field>
            <v-text-field
              name='Cellnumber'
              v-model="showCellnumber"
              label="Numero telefonico"
              prepend-icon="fas fa-phone"
              readonly
          ></v-text-field>
            <v-text-field
              v-model="showRol"
              label="Selecciona un rol"
              prepend-icon="fas fa-users"
              readonly
          ></v-text-field>
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
                  ref="form"
                  v-model="validEdit"
                  lazy-validation
                  >
            <v-card-text>
              <v-text-field
              name='user'
              v-model="editName"
              :rules="validUser"
              label="Nombre"
              prepend-icon="fas fa-user"
              required
            ></v-text-field>
            <v-text-field
              name='surname'
              v-model="editSurname"
              :rules="validSurname"
              label="Apellido"
              prepend-icon="fas fa-user-friends"
              required
            ></v-text-field>
                <v-text-field
                name='CI'
                v-model="editCI"
                :rules="validCI"
                prepend-icon="fas fa-address-card"
                label="Cedula de identidad"
                required
                ></v-text-field>
            <v-text-field
            v-model="editEmail"
            :rules="validEmail"
            label="E-mail"
            prepend-icon="fas fa-envelope"
            required
            ></v-text-field>
            <v-text-field
            v-model="editPassword"
            label="Contraseña"
            type="password"
            prepend-icon="fas fa-key"
            required
            ></v-text-field>
            <v-text-field
              name='Cellnumber'
              v-model="editCellnumber"
              :rules="validCellnumber"
              label="Numero telefonico"
              prepend-icon="fas fa-phone"
              required
          ></v-text-field>
            <span v-for="(error,index) in errors" :key="index" class="text-danger" >{{ errors }}</span>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                @click="cancelUpdate()"
                color="blue-grey"
                class="ma-2 white--text"
              >
              Cancelar
              </v-btn>
                <v-btn
                  :disabled="!validEdit"
                  color="success"
                  text
                  @click="updateUser()"
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
                    @click="destroyUser()"
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
          @click="addUser()"
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
      :items="users"
      :search="search"
    >
      <template v-slot:items="props">
        <template v-if="props.item.roles[0].id != 2">
        <td >{{ props.item.nombre }} </td>
        <td >{{ props.item.ci }}</td>
        <td >{{ props.item.email }}</td>
        <td >{{ props.item.roles[0].name }}</td>
        <td >{{ props.item.company.nombre }}</td>
        <td  class="text-xs-left">
           <v-flex row xs12 > 
          <v-btn
            color="grey" 
            icon
            @click="showUser(props.item)"
          >
          <i class="fa fa-eye" style="color:white"></i>
          </v-btn>
          <template v-if="props.item.id === connectUser.id">
          <v-btn
            color="blue" 
            icon
            @click="editUser(props.item)"
          >
          <i href="" class="fa fa-edit" style="color:white"></i>
          </v-btn>
          </template>
          <template v-else-if="connectUser.id === 1">
          <v-btn
            color="blue" 
            icon
            @click="editUser(props.item)"
          >
          <i href="" class="fa fa-edit" style="color:white"></i>
          </v-btn>
          </template>
          <template v-else-if="connectUserRol === 3">
            <v-btn
            color="blue" 
            icon
            @click="editUser(props.item)"
          >
          <i href="" class="fa fa-edit" style="color:white"></i>
          </v-btn>
          </template>
          <v-btn 
                v-if="props.item.id != 1"
                color="red" 
                icon
                @click="deleteUser(props.item.id)"
              >
              <i href="" class="fa fa-trash" style="color:white"></i>
            </v-btn>
          </v-flex>
        </td>
        </template>
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
        dialogCreate: false,
        dialogShow: false,
        dialogEdit: false,
        dialogDelete: false,
        validAdd: true,
        validEdit: true,
        dialog: false,
        addCompanySelect: true,
        connectUser: '',
        connectUserRol: '',
        newUser: '',
        newSurname: '',
        newCI: '',
        newEmail: '',
        newPassword: '',
        newCellnumber: '',
        newCompany: '',
        newRol: '',
        showName: '',
        showSurname: '',
        showCI: '',
        showEmail: '',
        showCellnumber: '',
        showCompany: '',
        showRol: '',
        showCF: '',
        showAF: '',
        editName: '',
        editSurname: '',
        editCI: '',
        editEmail: '',
        editPassword: '',
        editCellnumber: '',
        editid: '',
        addItemUser: {'name': '','email': '','password': '','cellnumber': '','company': '','rol': '','ci': '','surname': ''},
        editItemUser: {'name': '','email': '','password': '','cellnumber': '','ci': '','surname': ''},
        search: '',
        deleteUserid: '',
        users:[],
        companies: [],
        roles: [],
        errors: [],
        validUser: [
        v => !!v || 'Nombre es requerido',
        ],
        validSurname: [
          v => !!v || 'Apellido es requerido',
        ],
        validEmail: [
          v => !!v || 'E-mail es requerido',
          v => /.+@.+.com/.test(v) || 'E-mail tiene que ser valido'
        ],
        validPassword: [
            v => (v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
            'La contraseña debe tener una letra mayuscula y minuscula, un numero y un caracter especial',
            v => (v && v.length >= 8) || 'Contraseña debe tener minimo 8 caracteres'
        ],
        validCellnumber: [
          v => !!v || 'Telefono es requerido',
        ],
        validCompany: [
          v => !!v || 'Seleciona un compañia',
        ],
        validRol: [
          v => !!v || 'Seleciona un rol',
        ],
        validCI: [
          v => !!v || 'CI es requerido',
        ],
        headers: [
          {
            text: 'Nombre',
            align: 'left',
            value: 'nombre'
          },
          {
            text: 'Cedula',
            align: 'left',
            value: 'ci'
          },
          {
            text: 'E-mail',
            align: 'left',
            value: 'email'
          },
          {
            text: 'Rol',
            align: 'left',
            value: 'roles'
          },
          {
            text: 'Empresa',
            align: 'left',
            value: 'Company'
          },
          { text: 'Opciones',
            sortable: false,
            value: 'op' 
          },
        ],
      }
    },

    mounted() {
      this.getid()
      this.getidRol()
      this.getCompany();
      this.getRol();
      this.getUser();
    },

    methods:{
        getUser(){
            var urlTypes= "api/user/index";
            axios.get(urlTypes).then(response=>{
                this.users = response.data;
            });
        },
        getCompany(){
            var url= "api/company/index";
            axios.get(url).then(response=>{
                this.companies = response.data;
            });
        },
        getCompanyAdm(){
            var url= "api/company/index/adm";
            axios.get(url).then(response=>{
                this.companies = response.data;
            });
        },
        getCompanyGerente(){
            var url= "api/company/index/gerente";
            axios.get(url).then(response=>{
                this.companies = response.data;
            });
        },
        getRol(){
            var url= "api/roles/index";
            axios.get(url).then(response=>{
                this.roles = response.data;
            });
        },
        getid(){
            var url= "user/account";
            axios.get(url).then(response=>{
                this.connectUser = response.data;
            });
        },
        getidRol(){
            var url= "user/account/rol";
            axios.get(url).then(response=>{
                this.connectUserRol = response.data;
            });
        },
        addUser() {
          this.dialogCreate = true;
          this.errors = [];
        },
        reset () {
        this.$refs.formAdd.reset()
        this.addCompanySelect = true;
        this.getCompany();
        },
        validate () {
          if (this.$refs.formAdd.validate()) {
            this.snackbar = true
            this.createUser()
          }
        },
        rolesChange(value){
          if(value == 'Administrador'){
            this.addCompanySelect = false;
            this.getCompanyAdm();
            this.newCompany = 1
          }else{
            this.addCompanySelect = true;
            this.getCompanyGerente();
          }
        },
        deleteUser(value){
          this.dialogDelete = true;
          this.deleteUserid = value;
        },
        showUser(value){
          this.dialogShow = true;
          this.showName = value.nombre;
          this.showSurname = value.apellido;
          this.showCI = value.ci;
          this.showEmail = value.email;
          this.showCellnumber = value.telefono;
          this.showCompany = value.company.nombre;
          this.showRol = value.roles[0].name;
          this.showCF = value.created_at;
          this.showAF = value.updated_at;
        },

        createUser() {
            this.addItemUser.name = this.newUser;
            this.addItemUser.email = this.newEmail;
            this.addItemUser.password = this.newPassword;
            this.addItemUser.cellnumber = this.newCellnumber;
            this.addItemUser.company = this.newCompany;
            this.addItemUser.rol = this.newRol;
            this.addItemUser.ci = this.newCI;
            this.addItemUser.surname = this.newSurname;
            var url = 'api/user';
            axios.post(url, this.addItemUser).then(response => {
              this.getCompany();
              this.getRol();
              this.getUser();
              this.dialogCreate = false;
              this.errors = [];
              this.$refs.formAdd.reset()
              this.$toast.success('Se ah actualizada el dato')
            }).catch(error => {
              this.errors = [];
              this.errors = error.response.data
              this.$toast.error('Se origino un error')
            });
        },
        destroyUser() {
            var url = 'api/user/destroy/' + this.deleteUserid;
            axios.put(url).then(response => {
              this.getCompany();
              this.getRol();
              this.getUser();
              this.dialogDelete = false;
              this.$toast.success('Se ah borrado el dato')
            }).catch(error => {
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        editUser(value){
          this.errors = [];
          this.editPassword = null;
          this.editName = value.nombre;
          this.editSurname = value.apellido;
          this.editCI = value.ci;
          this.editEmail = value.email;
          this.editCellnumber = value.telefono;
          this.editid = value.id;
          this.dialogEdit = true;
        },
        updateUser() {
            this.editItemUser.name = this.editName;
            this.editItemUser.email = this.editEmail;
            this.editItemUser.password = this.editPassword;
            this.editItemUser.cellnumber = this.editCellnumber;
            this.editItemUser.ci = this.editCI;
            this.editItemUser.surname = this.editSurname;
            var url = 'api/user/update/' + this.editid;
            axios.put(url, this.editItemUser).then(response => {
            this.getCompany();
            this.getRol();
            this.getUser();
            this.dialogEdit = false;
            this.errors = [];
            this.$toast.success('Se ah actualizada el dato')
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },
        cancelCreate() {
           this.dialogCreate = false;
           this.$refs.formAdd.reset()
           this.addCompanySelect = true;
           this.getCompany();
        },
        cancelShow() {
           this.dialogShow = false;
        },
        cancelUpdate() {
           this.dialogEdit = false;
        },
    }
  }
</script>