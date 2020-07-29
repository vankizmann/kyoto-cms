<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <div class="kyo-titlebar col--flex-0-0">
                <div class="grid grid--row grid--middle grid--30">

                    <div class="col--flex-0-0">
                        <h2>{{ Obj.get($route, 'meta.menu.title', 'Edit page') }}</h2>
                    </div>

                    <div class="col--flex-0-0 col--right">
                        <NButton type="primary">
                            {{ trans('Save') }}
                        </NButton>
                        <NButton type="secondary">
                            {{ trans('Delete') }}
                        </NButton>
                        <NConfirm type="danger" @confirm="deleteItem">
                            {{ trans('Are you sure you want to delete this item?') }}
                        </NConfirm>
                    </div>
                </div>
            </div>
            
            <NForm class="col--flex-1-0">
                <NFormItem :label="trans('Title')" prop="title">
                    <NInput v-model="result.title"></NInput>
                </NFormItem>
                <NFormItem :label="trans('Content')" prop="content">
                    <NTextarea :auto-rows="true" v-model="result.content"></NTextarea>
                </NFormItem>
            </NForm>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPageEdit',

        data()
        {
            return {
                result: {}, load: true
            };
        },

        mounted()
        {
            this.$root.$on('locale:changed', this.fetchItem);

            this.fetchItem();
        },

        destroyed()
        {
            this.$root.$off('locale:changed');
        },

        methods: {

            fetchItem()
            {
                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                let query = {
                    id: this.$route.params.id
                };

                let route = this.Route.get('/{locale}/kyoto/page/http/controllers/page/show',
                    this.$root.$data, query);

                this.$http.get(route, options).then(this.updateItem, () => null);
            },

            updateItem(res)
            {
                this.result = res.data;
            },

            deleteItem()
            {
                console.log('DELETE ITEMS');
            }

        }

    }
</script>
