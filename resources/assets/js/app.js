
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Datepicker from 'vuejs-datepicker';
import ElementLoading from 'vue-element-loading'

window.Vue = require('vue');

var axios = require('axios');

Object.defineProperty(Vue.prototype, '$orgchart', { value: require('orgchart') });

Vue.component('roles-dropdown', require('./components/RolesDropdown.vue'));
Vue.component('refresher-dropdown', require('./components/RefresherDropdown.vue'));
Vue.component('roles-grid', require('./components/RolesGrid.vue'));
Vue.component('parent-child-dropdown', require('./components/ParentChildDropdown.vue'));
Vue.component('parent-child-management', require('./components/ParentChildManagement.vue'));
Vue.component('parent-text-child-management', require('./components/ParentTextChildManagement.vue'));
Vue.component('remove-object', require('./components/RemoveObject.vue'));
Vue.component('vue-element-loading', ElementLoading);
Vue.component('org-chart', require('./components/OrgChart.vue'));

window.onload = function () {
    const app = new Vue({
        el: '#app',
        components: {
            Datepicker
        }
    });
}

