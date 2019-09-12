<template>
  <v-card>
      <v-form 
        method="put"
        ref="form"
        v-model="valid"
        lazy-validation
        >
        <v-card-text>
            <v-text-field
                v-model="password"
                :rules="validPassword"
                label="Contraseña"
                type="password"
                prepend-icon="fas fa-key"
                required
            ></v-text-field>
            <span v-for="(error,index) in errors" :key="index" class="text-danger" >{{ errors }}</span>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="error"
              class="ma-2 white--text"
              @click="reset()"
              >
              Limpiar
              </v-btn>
              <v-btn
                :disabled="!valid"
                color="success"
                text
                @click="validate()"
              >
              Aceptar
            </v-btn>
          </v-card-actions>
      </v-form>
  </v-card>
</template>

<script>
  export default {
    props: ['id'],
    data () {
      return {
          valid: true,
          password: '',
          errors: '',
          ItemUser: {'password': ''},
          validPassword: [
            v => (v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
            'La contraseña debe tener una letra mayuscula y minuscula, un numero y un caracter especial',
            v => (v && v.length >= 8) || 'Contraseña debe tener minimo 8 caracteres'
        ],
      }
    },

    mounted() {
    },
     methods: {
         reset () {
        this.$refs.form.reset()
        },
        validate () {
          if (this.$refs.form.validate()) {
            this.snackbar = true
            this.update()
          }
        },
        update() {
            var url = '/api/user/reset/' + this.id;
            this.ItemUser.password = this.password;
            axios.put(url, this.ItemUser).then(response => {
            this.errors = [];
            this.$toast.success('Se ah actualizada la contraseña')
            }).catch(error => {
                this.errors = [];
                this.errors = error.response.data
                this.$toast.error('Se origino un error')
            });
        },

    },
        
    
  }
</script>