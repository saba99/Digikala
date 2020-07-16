window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//Vue.component('pagination', require('laravel-vue-pagination.vue'));


Vue.component('Cleave', require('vue-cleave-component'));

Vue.component('incredible-offers', require('./components/incredibleOffers.vue').default);
//import IncredibleOffers from './components/IncredibleOffers'
Vue.component('counter', require('./components/Counter.vue').default);

import axios from  'axios';
import VueAxios from  'vue-axios';
import Cleave from  'vue-cleave-component';

Vue.use(VueAxios,axios);
Vue.prototype.$siteUrl ='http//loaclhost/digikala/';

const app = new Vue({
    el: '#app',

    components:{
       
        // ExampleComponent,
        // incredibleOffers,
        // Cleave,
       

    }
});
