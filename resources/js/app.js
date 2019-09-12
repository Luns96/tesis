/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

import VuetifyToast from 'vuetify-toast-snackbar'

Vue.use(VuetifyToast, {
	x: 'right', // default
	y: 'top', // default
	color: 'info', // default
	icon: 'info',
	iconColor: '', // default
	classes: [
		'body-2'
	],
	timeout: 3000, // default
	dismissable: true, // default
	multiLine: false, // default
	vertical: false, // default
	queueable: false, // default
	showClose: true, // default
	closeText: '', // default
	closeColor: '', // default
	shorts: {
		custom: {
			color: 'purple'
		}
	},
	property: '$toast' // default
})

import ApexCharts from 'apexcharts'
// Vue.use(VuetifyToast)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//Tabla de datos
Vue.component('dt-type', require('./components/DataTable/type.vue').default);
Vue.component('dt-company', require('./components/DataTable/company.vue').default);
Vue.component('dt-user', require('./components/DataTable/user.vue').default);
Vue.component('dt-usergerente', require('./components/DataTable/userGerente.vue').default);
Vue.component('dt-project', require('./components/DataTable/project.vue').default);
Vue.component('dt-goals', require('./components/DataTable/goals.vue').default);
Vue.component('dt-objective', require('./components/DataTable/objective.vue').default);
// Vue.component('dt-objects', require('./components/DataTable/objects.vue').default);
Vue.component('dt-activity', require('./components/DataTable/activity.vue').default);

//Cartas de infomacion
Vue.component('card-project', require('./components/Card/ProjectInfo.vue').default);
Vue.component('card-goal', require('./components/Card/GoalInfo.vue').default);
Vue.component('card-account', require('./components/Card/Account.vue').default);
Vue.component('card-estatud', require('./components/Card/EstatudGoal.vue').default);
Vue.component('card-object', require('./components/Card/Object.vue').default);
Vue.component('card-reset', require('./components/Card/ResetPassword.vue').default);

//Reporte
Vue.component('report-account', require('./components/Card/Account.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
