import Vue from 'vue';
import VueRouter from 'vue-router';
import Routes from './routes';
import App from './components/App';

const router = new VueRouter({
    mode: 'history',
    routes: Routes,
});

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});