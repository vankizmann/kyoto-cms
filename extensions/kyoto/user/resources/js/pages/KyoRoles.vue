<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <div class="kyo-titlebar col--flex-0-0">
                <div class="grid grid--row">

                    <div class="col--flex-0-0 col--left">
                        <h2>Roles</h2>
                    </div>

                    <div class="col--flex-0-0 col--right">
                        <NButton type="primary" icon="fa fa-cog">Configure</NButton>
                    </div>
                </div>
            </div>

            <NTable class="col--flex-1-1" :items="result.data" :viewport-height="true" :filter-props.sync="query.filter" :sort-prop.sync="query.prop" :sort-dir.sync="query.dir" :allow-drop="() => false">
                <NTableColumn type="string" prop="title" label="Title" :fluid="true" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="string" prop="description" label="Description" :fluid="true" :sort="true"></NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" label="Modified" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="created_at" label="Created" :sort="true" :filter="true"></NTableColumn>
            </NTable>

            <NPaginator :page.sync="query.page" :limit.sync="query.limit" :total="result.total"></NPaginator>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoRoles',

        data()
        {
            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: []
            };

            return {
                query, result: {}, load: true
            };
        },

        mounted()
        {
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

            fetchItems()
            {
                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                let route = this.Route.get('/{locale}/kyoto/user/http/controllers/role/index',
                    this.$root.$data, this.query);

                this.$http.get(route, options).then(this.updateItems, () => null);
            },

            updateItems(res)
            {
                this.result = res.data;
            }

        }

    }
</script>
