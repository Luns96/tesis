<template>
    <v-form 
        v-on:submit.prevent="createUser" 
        method="post"
        ref="form"
        v-model="valid"
        lazy-validation>
        <div class="modal-body">
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
              prepend-icon="fas fa-user"
              required
            ></v-text-field>
            <v-layout row col>
      
                &nbsp;
                <v-text-field
                name='CI'
                v-model="newCI"
                :rules="validCI"
                prepend-icon="fas fa-address-card"
                label="Cedula de identidad"
                required
                ></v-text-field>
            </v-layout>
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
            ></v-select>
        </div>
        <div class="modal-footer">
            <v-btn
            color="error"
            @click="reset"
            >
            Resetear
            </v-btn>
            <v-btn
                :disabled="!valid"
                color="success"
                @click="validate"
                >
                Enviar
            </v-btn>
            
        </div>
    </v-form>
</template>

<script>
  export default {  


    data: () => ({
      valid: true,
      companies: [],
      roles: [],
      I: ['V','E'],
      newUser: '',
      newSurname: '',
      newCI: '',
      newEmail: '',
      newPassword: '',
      newCellnumber: '',
      newCompany: '',
      newRol: '',
      newData: {'name': '','email': '','password': '','cellnumber': '','company': '','rol': '','ci': '','surname': ''},
      error: [],
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
    }),

    mounted() {
        this.getCompany();
        this.getRol();
    },

    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
          this.createUser()
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      createUser: function() {
            this.newData.name = this.newUser;
            this.newData.email = this.newEmail;
            this.newData.password = this.newPassword;
            this.newData.cellnumber = this.newCellnumber;
            this.newData.company = this.newCompany;
            this.newData.rol = this.newRol;
            this.newData.ci = this.newCI;
            this.newData.surname = this.newSurname;
            console.log(this.newData);
            var url = "api/user";
            axios.post(url, this.newData,).then(response => {
                this.errors = [];
                // $('#AddTypeModal').modal('hide');
                location.reload();
                // toastr.success("dsadd");
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        getCompany(){
            var url= "api/company/index";
            axios.get(url).then(response=>{
                this.companies = response.data
            });
        },
        getRol(){
            var url= "api/roles/index";
            axios.get(url).then(response=>{
                this.roles = response.data
            });
        },
      
    }
  }
</script>
                // prueba
                // <v-select
                // :items="I"
                // length = '1'
                // outline
                // name="identificacion"
                // prepend-icon="fas fa-address-card"
                // v-model="newI"
                // item-value="V"
                // ></v-select>