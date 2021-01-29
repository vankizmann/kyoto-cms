import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoIndex',

    urls: {
        index: null,
        copy: null,
        delete: null
    },

    localized: false,

    stored: [
        'expanded',
        'selected'
    ],

    defaults() {

        let query = {
            page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
        };

        return { query };
    },

    data()
    {
        let query = {
            page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
        };

        let defaults = {
            query: query, result: {}, current: null, expanded: [], selected: [], load: true
        };

        let data = Obj.assign(defaults,
            this.ctor('defaults').call(this));

        let storedKeys = Arr.merge(this.ctor('stored'),
            ['query']);

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
            KyoIndex: this
        };
    },

    beforeMount()
    {
        Arr.each(this.ctor('stored'), (key) => {
            this.$watch(key, (value) => {
                return Obj.set(this.$root, this.__store(key), value);
            });
        });
    },

    mounted()
    {
        this.loadItems();

        if ( this.ctor('localized', false) ) {
            pi.Event.bind('locale:changed', this.loadItems, this._uid);
        }
    },

    unmounted()
    {
        pi.Event.unbind('locale:changed', this._uid);
    },

    watch: {

        'query.search': function () {
            this.loadItems();
        },

        'query.page': function () {
            this.loadItems();
        },

        'query.limit': function () {
            this.loadItems();
        },

        'query.prop': function () {
            this.loadItems();
        },

        'query.dir': function () {
            this.loadItems();
        },

        'query.filter': function () {
            this.loadItems();
        }

    },

    methods: {

        __self(prefix = null, suffix = null)
        {
            let name = this.ctor('name');

            if ( name.match(/ies$/) ) {
                name = name.replace(/ies$/, 'y');
            }

            if ( name.match(/s$/) ) {
                name = name.replace(/s$/, '');
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
         * Allow drag function for table
         * @returns {boolean}
         */
        allowDrag()
        {
            return true;
        },

        /**
         * Allow drop function for table
         * @returns {boolean}
         */
        allowDrop()
        {
            return false;
        },

        /**
         * Safezone for table
         * @returns {number}
         */
        safezone(height)
        {
            return height * 0.51;
        },

        /**
         * Move event
         * @returns {void}
         */
        onMove(source, target, strategy)
        {
            this.moveItems(source.split(','), target, strategy);
        },

        /**
         * Fetch items from server
         */
        loadItems()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get(this.ctor('urls.index'),
                this.$root.$data, this.query);

            Obj.set(this.$root, this.__self('store', 'Query'),
                Obj.clone(this.query));

            this.$http.get(route, options)
                .then(this.fetchDone, this.fetchError);
        },

        /**
         * Fetch items from server
         */
        moveItems(source, target, strategy)
        {
            if ( pi.Any.isEmpty(target) ) {
                return;
            }

            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get(this.ctor('urls.move'),
                this.$root.$data);

            let data = {
                source, target, strategy
            };

            this.$http.post(route, data, options)
                .then(this.loadItems, this.fetchError);
        },

        /**
         * Function when request succeeds
         * @param res
         */
        fetchDone(res)
        {
            this.selected = [];

            this.result = res.data;
        },

        /**
         * Function when request fails
         * @param res
         */
        fetchError(res)
        {
            //
        },

        /**
         * Delete items on server
         */
        deleteItems()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {
                ids: this.selected
            };

            let route = this.Route.get(this.ctor('urls.delete'),
                this.$root.$data);

            this.$http.post(route, query, options)
                .then(this.loadItems, this.fetchError);
        },

        /**
         * Goto edit form
         * @param row
         */
        gotoEdit(row)
        {
            this.$router.push({
                name: this.__self(null, 'Edit'), params: row.item
            });
        }

    }

}
