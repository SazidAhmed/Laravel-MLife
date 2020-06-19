import Vue from 'vue';
import Mywish from './components/Mywish.vue';
import Navbar from './components/Navbar.vue';
import Awish from './components/Awish.vue';

//Axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
Vue.prototype.$http = window.axios
let axios = require('axios');

window.onload = function ()
{
    const nav = new Vue({
        el: '#nav',
        render: h=> h( Navbar)
    });

    const mywish = new Vue({
        el: '#mywish',
        render: h=> h( Mywish)
    });

    const awish = new Vue({
        el: '#awish',
        render: h=> h( Awish)
    });
}


