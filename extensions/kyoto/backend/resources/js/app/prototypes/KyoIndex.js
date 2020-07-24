export default {

    name: 'KyoIndex',

    urls: {
        index: null, copy: null, delete: null
    },

    stored: [
        'expanded', 'selected'
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

        let data = this.Obj.assign({
            query, result: {}, expanded: [], selected: [], load: true
        }, this.ctor('defaults').call(this));

        let storedKeys = this.Arr.merge(this.ctor('stored'), ['query']);

        this.Arr.each(storedKeys, (key) => {
            if ( this.Obj.has(this.$root, this._storeKey(key)) ) {
                this.Obj.set(data, key, this.Obj.get(this.$root, this._storeKey(key)));
            }
        });

        return data;
    },

    mounted()
    {
        this.$watch('query.search', this.Any.debounce(this.fetchItems, 800));

        this.$root.$on('locale:changed', this.fetchItems);

        this.Arr.each(this.ctor('stored'), (key) => {
            this.$watch(key, (value) => {
                this.Obj.set(this.$root, this._storeKey(key), value);
            });
        });

        this.fetchItems();
    },

    destroyed()
    {
        this.$root.$off('locale:changed');
    },

    watch: {

        'query.page': function () {
            this.fetchItems();
        },

        'query.limit': function () {
            this.fetchItems();
        },

        'query.prop': function () {
            this.fetchItems();
        },

        'query.dir': function () {
            this.fetchItems();
        },

        'query.filter': function () {
            this.fetchItems();
        }

    },

    methods: {

        _selfName(prefix = null, suffix = null)
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

        _storeKey(key)
        {
            let exploded = key.split('.');

            this.Arr.map(exploded, (key) => {
                return key.charAt(0).toUpperCase() + key.slice(1);
            });

            return this._selfName('store', exploded.join(''));
        },

        allowDrag()
        {
            return false;
        },

        allowDrop()
        {
            return false;
        },

        fetchItems()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get(this.ctor('urls.index'),
                this.$root.$data, this.query);

            this.Obj.set(this.$root, this._selfName('store', 'Query'),
                this.Obj.clone(this.query));

            this.$http.get(route, options).then(this.updateItems, () => null);
        },

        updateItems(res)
        {
            this.result = res.data;
        },

        deleteItems()
        {
            console.log('DELETE ITEMS');
        },

        gotoEdit(row)
        {
            this.$router.push({
                name: this._selfName(null, 'Edit'), params: row
            });
        }

    }

}
