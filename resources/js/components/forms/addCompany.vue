<template>
    <v-form 
        v-on:submit.prevent="createCompany" 
        method="post"
        ref="form"
        v-model="valid"
        lazy-validation>
        <div class="modal-body">
          <v-text-field
              name='Rif'
              v-model="newRif"
              :rules="validRif"
              label="Rif"
              prepend-icon="fas fa-pencil-ruler"
              required
          ></v-text-field>
          <v-text-field
              name='Name'
              v-model="newCompany"
              :rules="validCompanyName"
              label="Nombre de la compañia"
              prepend-icon="far fa-building"
              required
          ></v-text-field>
          <v-select
          :items="types"
          label="Selecciona el tipo de empresa"
          name="type"
          prepend-icon="fas fa-industry"
          :rules="validType"
          v-model="newType"
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
           <v-textarea
              name='Address'
              rows="2"
              v-model="newAddress"
              :rules="validCompanyAddress"
              label="dirección de la compañia"
              prepend-icon="far fa-address-book"
              required
          ></v-textarea>
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
      types: [],
      newCompany: '',
      newRif: '',
      newAddress: '',
      newCellnumber: '',
      newType: '',
      error: [],
      newData: {'name': '', 'rif': '', 'address': '', 'cellphone': '', 'type': ''},
      validRif: [
        v => !!v || 'Rif es requerido',
      ],
      validCompanyAddress: [
        v => !!v || 'Dirección es requerido',
      ],
      validCompanyName: [
        v => !!v || 'Nombre es requerido',
      ],
       validCellnumber: [
        v => !!v || 'Telefono es requerido',
      ],
      validType: [
        v => !!v || 'Seleciona un tipo',
      ],
    }),

    mounted() {
        this.getTypes();
    },

    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
          this.createCompany()
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      createCompany: function() {
        this.newData.name = this.newCompany;
        this.newData.rif = this.newRif;
        this.newData.address = this.newAddress;
        this.newData.cellphone = this.newCellnumber;
        this.newData.type = this.newType;
        var url = "api/company";
        axios.post(url, this.newData).then(response => {
            location.reload();
            // toastr.success("dsadd");
        }).catch(error => {
            this.errors = error.response.data
        });
        },
      getTypes(){
            var urlTypes= "api/type/index";
            axios.get(urlTypes).then(response=>{
                this.types = response.data
            });
        },
      
    }
  }
</script>