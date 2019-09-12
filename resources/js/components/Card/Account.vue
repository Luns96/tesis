<template>

  <v-card
  >
  <v-card-text>
     <v-layout row col>
      <v-text-field
            v-model="viewName"
            label="Nombre"
            prepend-icon="fas fa-user"
            readonly
        ></v-text-field>
      <v-text-field
            v-model="viewSurname"
            label="Apellido"
            prepend-icon="fas fa-user-friends"
            readonly
        ></v-text-field>
         <v-text-field
            v-model="viewci"
            label="Cedula"
            prepend-icon="fas fa-address-card"
            readonly
        ></v-text-field>
     </v-layout>
     <v-layout row col>
      <v-text-field
            v-model="viewEmail"
            label="Correo"
            prepend-icon="fas fa-envelope"
            readonly
        ></v-text-field>
      <v-text-field
            v-model="viewCellphone"
            label="Telefono personal"
            prepend-icon="fas fa-phone"
            readonly
        ></v-text-field>
    </v-layout>
        <v-layout row col>
      <v-text-field
            v-model="viewCompany"
            label="Empresa"
            prepend-icon="far fa-building"
            readonly
        ></v-text-field>
      <v-text-field
            v-model="rol"
            label="Rol de la empresa"
            prepend-icon="fas fa-users"
            readonly
        ></v-text-field>
        <v-text-field
            v-model="viewCompanyType"
            label="Tipo de la empresa"
            prepend-icon="fas fa-industry"
            readonly
        ></v-text-field>
        </v-layout>
        <v-layout row col>
      <v-text-field
            v-model="viewCompanyRif"
            label="Rif de la empresa"
            prepend-icon="fas fa-pencil-ruler"
            readonly
        ></v-text-field>
      <v-text-field
            v-model="viewCompanyCellphone"
            label="Telefono de la empresa"
            prepend-icon="fas fa-phone-square"
            readonly
        ></v-text-field>
    </v-layout>
    
    
  </v-card-text>
  
  </v-card>
</template>

<script>
  export default {
    props: ['id','rol'],
    data () {
      return {
        viewName: '',
        viewSurname: '',
        viewci: '',
        viewCompany: '',
        viewCompanyCellphone: '',
        viewCompanyType: '',
        viewCompanyRif: '',
        viewEmail: '',
        viewCellphone: '',
        account: '',
      }
    },

    mounted() {
        this.getAccount()
    },

    methods: {

        getAccount () {
          var url= "api/user/" + this.id;
          axios.get(url).then(response=>{
                this.account = response.data;
                this.viewName = this.account.nombre;
                this.viewSurname = this.account.apellido;
                this.viewci = this.account.ci;
                this.viewCompany = this.account.company.nombre;
                this.viewCompanyCellphone = this.account.company.telefono;
                this.viewCompanyType = this.account.company.type.nombre;
                this.viewCompanyRif = this.account.company.rif;
                this.viewEmail = this.account.email;
                this.viewCellphone = this.account.telefono;
                this.$toast.info('Bienvenido a su cuenta')
            });
        },
    },
    
  }
</script>