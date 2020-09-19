<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoPages' }" class="col--flex-0-0">
                <template slot="action">
                    <NButton type="primary">
                        {{ trans('Save') }}
                    </NButton>
                    <NButton type="secondary">
                        {{ trans('Delete') }}
                    </NButton>
                    <NConfirm type="danger" @confirm="deleteItem">
                        {{ trans('Are you sure you want to delete this item?') }}
                    </NConfirm>
                </template>
            </KyoTitlebar>

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

        name: 'KyoPageCreate',

        urls: {
            create: '/{locale}/kyoto/page/http/controllers/page/create',
            store: '/{locale}/kyoto/page/http/controllers/page/store'
        },

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


                let route = this.Route.get('/{locale}/kyoto/page/http/controllers/page/create',
                    this.$root.$data);

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
