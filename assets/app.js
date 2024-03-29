import { createApp } from 'vue';
import { createPinia } from 'pinia';

import router from './router';

import App from './App';
import './styles/app.css';

const pinia = createPinia();

const app = createApp(App);
app.use(pinia);
app.use(router);
app.mount('#app');
