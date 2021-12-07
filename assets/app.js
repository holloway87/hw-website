import Vue from 'vue';
import BootstrapVue from 'bootstrap-vue';

import App from './App';
import './styles/app.scss';

Vue.use(BootstrapVue);

new Vue({
    render: h => h(App),
}).$mount('#app');
