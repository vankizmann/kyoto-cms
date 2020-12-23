import { Arr, Obj } from 'nano-js';

export default {

    name: 'KyoIndex',

    localized: false,

    refresh: true,

    urls: {
        index: null,
        copy: null,
        delete: null
    },


    stored: [
        //
    ],

    defaults()
    {
        return {
            result: {}, errors: {}, load: true
        };
    },

    data()
    {
        let defaults = {
            result: {}, errors: {}, load: true
        };

        let data = Obj.assign(defaults,
            this.ctor('defaults').call(this));

        let storedKeys = this.ctor('stored');

        Arr.each(storedKeys, (key) => {
            if ( Obj.has(this.$root, this.__store(key)) ) {
                Obj.set(data, key, Obj.get(this.$root, this.__store(key)));
            }
        });

        return data;
    },

    provide()
    {
        return {
            KyoForm: this
        };
    },

    beforeRouteUpdate(to, from, next)
    {
        this.loadItem(to);

        next();
    },

    mounted()
    {
        this.loadItem();

        if ( this.ctor('localized', false) ) {
            Nano.Event.bind('locale:changed', this.loadItem, this._uid);
        }
    },

    destroyed()
    {
        Nano.Event.unbind('locale:changed', this._uid);
    },

    methods: {

        __self(prefix = null, suffix = null)
        {
            let name = this.ctor('name');

            if ( name.match(/(Create|Edit)$/) ) {
                name = name.replace(/(Create|Edit)$/, 'Form');
            }

            return [prefix, name, suffix].join('');
        },

        __store(key)
        {
            let exploded = key.split('.');

            Arr.map(exploded, (key) => {
                return key.charAt(0).toUpperCase() + key.slice(1);
            });

            return this.__self('store', exploded.join(''));
        },

        /**
         * Fetch items from server
         */
        loadItem(nextRoute)
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {};

            if ( Nano.Obj.has(this.$route, 'params.id') ) {
                query.id = Nano.Obj.get(this.$route, 'params.id');
            }

            if ( Nano.Obj.has(nextRoute, 'params.id') ) {
                query.id = Nano.Obj.get(nextRoute, 'params.id');
            }

            let route = this.Route.get(this.ctor('urls.show'),
                this.$root.$data, query);

            this.$http.get(route, options)
                .then(this.fetchDone, this.fetchError);
        },

        updateItem()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {
                id: this.$route.params.id
            };

            let route = this.Route.get(this.ctor('urls.update'),
                this.$root.$data, query);

            this.$http.post(route, this.result, options)
                .then(this.fetchDoneSave, this.fetchError);
        },

        updateCloseItem()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {
                id: this.$route.params.id
            };

            let route = this.Route.get(this.ctor('urls.update'),
                this.$root.$data, query);

            this.$http.post(route, this.result, options)
                .then(this.fetchDoneClose, this.fetchError);
        },

        storeItem()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get(this.ctor('urls.store'),
                this.$root.$data);

            this.$http.post(route, this.result, options)
                .then(this.fetchDoneFirst, this.fetchError);
        },

        storeItemClose()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get(this.ctor('urls.store'),
                this.$root.$data);

            this.$http.post(route, this.result, options)
                .then(this.fetchDoneClose, this.fetchError);
        },

        /**
         * Delete items on server
         */
        deleteItem()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {
                ids: [this.$route.params.id]
            };

            let route = this.Route.get(this.ctor('urls.delete'),
                this.$root.$data);

            this.$http.post(route, query, options)
                .then(this.fetchDoneClose, this.fetchError);
        },

        /**
         * Function when request succeeds
         * @param res
         */
        fetchDone(res)
        {
            this.result = Obj.get(res.data, 'data', {});
        },

        /**
         * Function when request succeeds
         * @param res
         */
        fetchDoneSave(res)
        {
            if ( this.ctor('refresh', false) ) {
                Nano.Store.refresh('menus');
            }

            this.result = Obj.get(res.data, 'data', {});
        },

        fetchDoneFirst(res)
        {
            this.result = Obj.get(res.data, 'data', {});

            if ( this.ctor('refresh', false) ) {
                Nano.Store.refresh('menus');
            }

            this.gotoEdit(res.data);
        },

        fetchDoneClose(res)
        {
            this.result = Obj.get(res.data, 'data', {});

            if ( this.ctor('refresh', false) ) {
                Nano.Store.refresh('menus');
            }

            this.gotoIndex(res.data);
        },

        /**
         * Function when request fails
         * @param res
         */
        fetchError(res)
        {
            this.errors = Obj.get(res.data, 'errors', {});
        },

        /**
         * Goto index
         */
        gotoIndex()
        {
            //
        },

        /**
         * Goto edit form
         */
        gotoEdit()
        {
            //
        }

    }

}
