<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <div class="kyo-titlebar col--flex-0-0">
                <div class="grid grid--row grid--middle grid--30">

                    <div class="col--flex-0-0">
                        <h2>{{ Obj.get($route, 'meta.menu.title', 'Roles') }}</h2>
                    </div>

                    <div class="col--flex-0-1 col--left">
                        <NInput v-model="query.search" size="large" :placeholder="trans('Search')" icon="fa fa-search"></NInput>
                    </div>

                    <div class="col--flex-0-0 col--right">
                        <NButton type="primary" @click="$router.push({ name: 'KyoUsers' })">
                            {{ trans('Add menu') }}
                        </NButton>
                        <NButton type="secondary" :disabled="! selected.length">
                            {{ trans('Delete') }}
                        </NButton>
                        <NConfirm type="danger" @confirm="deleteItems">
                            {{ trans('Are you sure you want to delete :count items?', { count: selected.length }) }}
                        </NConfirm>
                    </div>
                </div>
            </div>

            <NTable class="kyo-table col--flex-1-1" :items="result.data" :viewport-height="true" :selected.sync="selected" :filter-props.sync="query.filter" :sort-prop.sync="query.prop" :sort-dir.sync="query.dir" :item-height="44" :render-expand="true" :allow-drag="allowDrag" :allow-drop="allowDrop" @row-dblclick="gotoEdit">
                <NTableColumn type="string" prop="title" label="Title" :fluid="true" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="string" prop="route" label="Route" :fluid="true" :sort="true"></NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" label="Modified" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="created_at" label="Created" :sort="true" :filter="true"></NTableColumn>
            </NTable>

            <NPaginator :total="result.total" :layout="['count', 'spacer']"></NPaginator>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoMenus',

        data()
        {
            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
            };

            if ( this.$root.storeKyoRoles ) {
                query = this.$root.storeKyoRoles;
            }

            return {
                query, result: {}, selected: [], load: true
            };
        },

        mounted()
        {
            this.$watch('query.search', this.Any.debounce(this.fetchItems, 800));

            this.$root.$on('locale:changed', this.fetchItems);

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

                let route = this.Route.get('/{locale}/kyoto/menu/http/controllers/menu/index',
                    this.$root.$data, this.query);

                this.$root.storeKyoRoles = this.Obj.clone(this.query);

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
                    name: 'KyoMenuEdit', params: row
                });
            }

        }

    }
</script>
