<template>
<div class="card-body">

  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="name"
      :rules="nameRules"
      label="Nombre"
      required
    ></v-text-field>

    <v-text-field
      v-model="email"
      :rules="emailRules"
      label="E-mail"
      required
    ></v-text-field>

    <v-text-field
      v-model="password"
      :rules="passwordRules"
      label="Password"
      type="password"
      required
    ></v-text-field>

    <v-select
      v-model="companie"
      :items="companies"
      :rules="[v => !!v || 'Compañia requerido']"
      label="Compañia"
      required
    ></v-select>

    <v-select
      v-model="Role"
      :items="Roles"
      :rules="[v => !!v || 'Cargo requerido']"
      label="Cargo"
      required
    ></v-select>

    <v-btn
      :disabled="!valid"
      color="success"
      @click="validate"
    >
      Enviar
    </v-btn>

    <v-btn
      color="error"
      @click="reset"
    >
      Resetear
    </v-btn>

  </v-form>
</div>
</template>

<script>
  export default {
    data: () => ({
      valid: true,
      name: '',
      nameRules: [
        v => !!v || 'Nombre es requerido',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail es requerido',
        v => /.+@.+.com/.test(v) || 'E-mail tiene que ser valido'
      ],
      password: '',
      passwordRules: [
          v => (v || '').match(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/) ||
          'Contraseña debe tener una letra mayuscula y minuscula, un numero y un caracter especial',
          v => (v && v.length >= 8) || 'Contraseña debe tener minimo 8 caracteres'
      ],
      Role: null,
      Roles: [
        'Administrador',
        'Usuario',
      ],
      companie: null,
      companies: [
        'aqui va los datos',
      ],
    }),

    methods: {
      validate () {
        if (this.$refs.form.validate()) {
          this.snackbar = true
        }
      },
      reset () {
        this.$refs.form.reset()
      },
    }
  }
</script>