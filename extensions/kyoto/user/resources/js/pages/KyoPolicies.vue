<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <div class="kyo-titlebar col--flex-0-0">
                <div class="grid grid--row grid--middle grid--30">

                    <div class="col--flex-0-0">
                        <h2>{{ Obj.get($route, 'meta.menu.title', 'Policies') }}</h2>
                    </div>

                    <div class="col--flex-0-1 col--left">
                        <NInput v-model="query.search" size="large" :placeholder="trans('Search')" icon="fa fa-search" :icon-disabled="true"></NInput>
                    </div>

                    <div class="col--flex-0-0 col--right">
                        <NButtonGroup v-show="selected.length">
                            <NButton type="secondary" :square="true" icon="fa fa-copy">
                                <!-- Copy icon -->
                            </NButton>
                            <NButton type="secondary" :square="true" icon="fa fa-trash">
                                <!-- Delete icon -->
                            </NButton>
                            <NConfirm type="danger" @confirm="deleteItems">
                                {{ trans('Are you sure you want to delete :count items?', { count: selected.length }) }}
                            </NConfirm>
                        </NButtonGroup>
                    </div>

                    <div class="col--flex-0-0">
                        <NButton type="primary" @click="$router.push({ name: 'KyoRoleEdit' })">
                            {{ trans('Add policy') }}
                        </NButton>
                    </div>
                </div>
            </div>

            <NTable class="kyo-table col--flex-1-1" :items="result.data" :viewport-height="true" :selected.sync="selected" :filter-props.sync="query.filter" :sort-prop.sync="query.prop" :sort-dir.sync="query.dir" :item-height="44" :allow-drag="allowDrag" :allow-drop="allowDrop">
                <NTableColumn type="string" prop="title" :label="trans('Title')" :fluid="true" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="string" prop="type" :label="trans('Type')" :fluid="true" :sort="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="string" prop="action" :label="trans('Action')" :fluid="true" :sort="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" :label="trans('Modified')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="datetime" prop="created_at" :label="trans('Created')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>
            </NTable>

            <NPaginator :page.sync="query.page" :limit.sync="query.limit" :total="result.total"></NPaginator>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPolicies',

        data()
        {
            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
            };

            if ( this.$root.storeKyoPolicies ) {
                query = this.$root.storeKyoPolicies;
            }

            return {
                query, result: {}, selected: [], load: true
            };
        },

        mounted()
        {
            this.$watch('query.search', this.Any.debounce(this.fetchItems, 800));

            this.fetchItems();
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

                let route = this.Route.get('/{locale}/kyoto/user/http/controllers/policy/index',
                    this.$root.$data, this.query);

                this.$root.storeKyoPolicies = this.Obj.clone(this.query);

                this.$http.get(route, options).then(this.updateItems, () => null);
            },

            updateItems(res)
            {
                this.result = res.data;
            },

            deleteItems()
            {
                console.log('DELETE ITEMS');
            }

        }

    }
</script>
