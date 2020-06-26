<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <div class="kyo-titlebar col--flex-0-0">
                <div class="grid grid--row">

                    <div class="col--flex-0-0 col--left">
                        <h2>Users</h2>
                    </div>

                    <div class="col--flex-0-0 col--right">
                        <NButton type="primary" icon="fa fa-cog">Configure</NButton>
                    </div>
                </div>
            </div>

            <NTable class="col--flex-1-1" :items="result.data" :viewport-height="true">
                <NTableColumn type="string" prop="email" label="E-Mail" :fluid="true"></NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" label="Modified"></NTableColumn>
                <NTableColumn type="datetime" prop="created_at" label="Created"></NTableColumn>
            </NTable>

            <NPaginator :page.sync="query.page" :limit.sync="query.limit" :total="result.total"></NPaginator>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoUsers',

        data()
        {
            let query = {
                page: 1, limit: 25
            };

            return {
                query, result: {}, load: true
            };
        },

        mounted()
        {
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
            }

        },

        methods: {

            fetchItems()
            {
                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                let route = this.Route.get('/{locale}/kyoto/user/http/controllers/user/index',
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
