import { Arr, Obj, Any, Locale, Event } from "@kizmann/pico-js";

export class Kyoto {

    static pagetitle = null;

    static user = null;

    static paths = {
        base: '/', login: '/login', logout: '/logout'
    };

    static routes = [];

    static dashes = [];

    static languages = [];

    static components = {};

    static waiters = [];

    static getPagetitle()
    {
        if ( ! Kyoto.pagetitle ) {
            Kyoto.pagetitle = document.title;
        }

        return Kyoto.pagetitle;
    }

    static setPaths(paths)
    {
        if ( Any.isString(paths) ) {
            paths = JSON.parse(paths);
        }

        Kyoto.paths = paths;
    }

    static setUser(user)
    {
        if ( Any.isString(user) ) {
            user = JSON.parse(user);
        }

        Kyoto.user = user;
    }

    static setTranslations(locales)
    {
        if ( Any.isString(locales) ) {
            locales = JSON.parse(locales);
        }

        Locale.locales = locales;
    }

    static setRoutes(routes)
    {
        if ( Any.isString(routes) ) {
            routes = JSON.parse(routes);
        }

        Kyoto.routes = routes;
    }

    static getVisibleRoutes(routes = null)
    {
        return Arr.filter(routes || Kyoto.routes,
            menu => ! menu.hide);
    }

    static setLanguages(languages)
    {
        if ( Any.isString(languages) ) {
            languages = JSON.parse(languages);
        }

        Kyoto.languages = languages;
    }

    static addDash(value)
    {
        value = Obj.assign({
            type: 'undefined',
            title: '',
            description: '',
            tags: [],
            callback: () => null
        }, value);

        Kyoto.dashes.push(value);

        Event.fire('KyoDash:update', Kyoto.dashes);
    }

    static component(name, data = null)
    {
        if ( data === null ) {
            return Obj.get(Kyoto.components, name)
        }

        Obj.set(Kyoto.components, name, data);
    }

    static ready(callback)
    {
        Arr.push(Kyoto.waiters, callback);
    }

}

export default Kyoto;
