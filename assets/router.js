import { createRouter, createWebHistory } from 'vue-router';
import useDefaultStore from './store';

const router = new createRouter({
    'history': createWebHistory(),
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
            'path': '/photo-projects/analog',
            'name': 'Analog photos',
            'component': () => import(/* webpackChunkName: "photos-analog" */'./views/photos-analog'),
        },
        {
            'path': '/photo-projects/bw-analog',
            'name': 'Black & White analog photos',
            'component': () => import(/* webpackChunkName: "photos-bw-analog" */'./views/photos-bw-analog'),
        },
        {
            'path': '/photo-projects/clouds',
            'name': 'Cloud photos',
            'component': () => import(/* webpackChunkName: "photos-clouds" */'./views/photos-clouds'),
        },
        {
            'path': '/photo-projects/macro',
            'name': 'Macro photos',
            'component': () => import(/* webpackChunkName: "photos-macro" */'./views/photos-macro'),
        },
        {
            'path': '/photo-projects/mia',
            'name': 'My cat Mia',
            'component': () => import(/* webpackChunkName: "photos-macro" */'./views/photos-mia'),
        },
        {
            'path': '/dev',
            'name': 'Programming',
            'component': () => import(/* webpackChunkName: "dev" */'./views/dev'),
        },
        {
            'path': '/timeline',
            'name': 'Timeline',
            'component': () => import(/* webpackChunkName: "timeline" */'./views/timeline'),
        },
        {
            'path': '/timeline-admin',
            'name': 'Timeline Admin',
            'component': () => import(/* webpackChunkName: "timeline-admin" */'./views/timeline-admin'),
            'meta': {
                'auth': true
            },
        },
        {
            'path': '/timeline-admin/edit-:id',
            'name': 'Timeline Admin - Edit Entry',
            'component': () => import(/* webpackChunkName: "timeline-admin-edit-entry" */'./views/timeline-admin-edit-entry'),
            'meta': {
                'auth': true
            },
        },
        {
            'path': '/timeline/:id',
            'name': 'Timeline Entry',
            'component': () => import(/* webpackChunkName: "timeline-entry" */'./views/timeline-entry'),
        },
        {
            'path': '/admin-login',
            'name': 'Admin Login',
            'component': () => import(/* webpackChunkName: "admin-login" */'./views/admin-login'),
        },
    ],
});

router.beforeEach((to, from, next) => {
    const store = useDefaultStore();

    if (to.meta.auth && !store.logged_in) {
        next('/admin-login');
    } else {
        next();
    }
});

export default router;
