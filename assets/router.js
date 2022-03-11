import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    'mode': 'history',
    'routes': [
        {
            'path': '/',
            'name': 'Home',
            'component': () => import(/* webpackChunkName: "home" */'./views/home'),
        },
        {
            'path': '/illustrations',
            'name': 'Art',
            'component': () => import(/* webpackChunkName: "art" */'./views/art'),
        },
        {
            'path': '/illustrations/maaya-community-doodles',
            'name': 'Maaya\'s community doodles',
            'component': () => import(/* webpackChunkName: "art-maaya-community-doodles" */'./views/art-maaya-community-doodles'),
        },
        {
            'path': '/illustrations/the-life-of-abe',
            'name': 'The Life of Abe',
            'component': () => import(/* webpackChunkName: "art-the-life-of-abe" */'./views/art-the-life-of-abe'),
        },
        {
            'path': '/photo-projects',
            'name': 'Photos',
            'component': () => import(/* webpackChunkName: "photos" */'./views/photos'),
        },
        {
            'path': '/photo-projects/macro',
            'name': 'Macro photos',
            'component': () => import(/* webpackChunkName: "photos-macro" */'./views/photos-macro'),
        },
        {
            'path': '/dev',
            'name': 'Programming',
            'component': () => import(/* webpackChunkName: "dev" */'./views/dev'),
        },
    ],
});

export default router;
