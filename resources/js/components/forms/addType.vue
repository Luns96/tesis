<template>
    <v-form 
        v-on:submit.prevent="createType" 
        method="post"
        ref="form"
        v-model="valid"
        lazy-validation>
        <div class="modal-body">
                <v-text-field
                    name='type'
                    v-model="newType"
                    :rules="typeRules"
                    label="tipo"
                    prepend-icon="fa fa-industry"
                    required
                ></v-text-field>
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
      newType: '',
      newData: {'type': ''},
      error: [],
      typeRules: [
        v => !!v || 'Tipo es requerido',
      ],
    }),

    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
          this.createType()
        }
      },
      reset () {
        this.$refs.form.reset()
      },
      createType: function() {
            var url = "api/type";
            this.newData.type = this.newType
            axios.post(url, this.newData,).then(response => {
                this.errors = [];
                $('#AddTypeModal').modal('hide');
                location.reload();
                // toastr.success("dsadd");
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        
      
    }
  }
</script>