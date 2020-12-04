import Vue from 'vue';
import Router from 'vue-router';
import user from "./user";
import app from '../config';

Vue.use(Router);

const routes_footer = app.footer.map((item) => {
    return {
        path: item.path,
        name: `Foot${item.name}`,
        meta: {
            title: item.title,
            auth: item.auth,
            footer: true
        },
        component: () =>
            import (`@/views${item.view}`)
    }
});

const routes = [...routes_footer, {
    path: '/',
    name: 'Home',
    meta: {
        title: '首页',
    },
    component: () =>
        import ('@/views/home/Home')
}, ...user, {
    path: '*',
    name: 'NotDefined',
    component: () =>
        import ('@/views/home/Home')
}];

const router = new Router({
    routes
});

router.beforeEach((to, from, next) => {
    const { title } = to.meta;
    document.title = title;
    next();
});

export default router;