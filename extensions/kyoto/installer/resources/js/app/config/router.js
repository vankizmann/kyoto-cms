import Vue from "vue";
import VueRouter from 'vue-router';

let vueRoutes = [];

let resolveMenu = (menu, cascade) => {

   let root = Vue.Arr.get(cascade, 0);

    let route = {
        path: `${menu.route}`, name: menu.id, meta: { root, menu }
    };

    let redirect = Vue.Obj.get(menu, 'extend.redirect');

    if ( redirect !== null ) {
        route.redirect = () => {
            return { name: redirect };
        }
    }

    let component = Vue.Obj.get(menu, 'extend.component');

    if ( component !== null ) {
        route.component = () => {
            return Vue.Extension.promise(component, () => Vue.component(component));
        };
    }

    vueRoutes.push(route);
};

Vue.Arr.recursive(window._menus || [], 'children', resolveMenu);

Vue.prototype.findRoute = function (search) {

    let route = Vue.Arr.find(this.$router.options.routes, (item) => {
        return Vue.Obj.get(item, 'meta.menu.extend.component') === search;
    });

    return this.Obj.get(route, 'name', null);
};

export default new VueRouter({
    base: window.basePath, mode: 'history', routes: vueRoutes
});

