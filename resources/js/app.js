/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import Vue from '@inertiajs/vue3';
import DashBoard from './Components/DashboardUser.vue';

Vue.component('example-component', DashBoard);

const app = new Vue({
    el: '#app',
});
