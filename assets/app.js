import { createApp } from 'vue';
import { createPinia } from 'pinia';

import router from './router';

import Main from './Main';
import './styles/app.css';

const pinia = createPinia();

const app = createApp(Main);
app.use(pinia);
app.use(router);
app.mount('#app');
