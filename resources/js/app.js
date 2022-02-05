/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
//  */

require('./bootstrap');



import { createApp } from 'vue';

import App from './App.vue'

let app=createApp(App);
import vue3StarRatings from "vue3-star-ratings";
import router from './routes'
app.use(router);


app.component("vue3-star-ratings", vue3StarRatings);

import VueCreditCardValidation from 'vue-credit-card-validation';
app.use(VueCreditCardValidation);

app.mount('#app')



