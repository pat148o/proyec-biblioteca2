
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuelidate from 'vuelidate'
Vue.use(Vuelidate);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('autors', require('./components/Autors.vue'));
Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('editorial', require('./components/Editorial.vue'));
Vue.component('idioma', require('./components/Idioma.vue'));
Vue.component('pais', require('./components/Pais.vue'));
Vue.component('libros', require('./components/libro.vue'));
Vue.component('personas', require('./components/Personas.vue'));
Vue.component('prestamo', require('./components/prestamo.vue'));
Vue.component('users', require('./components/Users.vue'));

const app = new Vue({
    el: '#app',
    data:{
    menu:0
    }
});
