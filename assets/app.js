import { createApp } from 'vue';
import { createPinia } from 'pinia';

import marked from './lib/marked-wrapper';
import router from './router';

import Main from './Main';
import './styles/app.css';

const pinia = createPinia();

const app = createApp(Main);
app.use(pinia);
app.use(router);
app.provide('marked', marked);
app.mount('#app');
