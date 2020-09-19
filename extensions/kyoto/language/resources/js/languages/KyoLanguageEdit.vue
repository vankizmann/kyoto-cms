<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoLanguages' }" class="col--flex-0-0">
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
            
            <NForm class="kyo-dataform col--flex-1-0">

                <NFormGroup icon="fa fa-cog" :legend="trans('Settings')">

                    <div class="grid grid-row grid--wrap grid--20-20">

                        <NFormItem class="col--1-1 col--1-2@sm" :label="trans('State')" prop="state">
                            <NSwitch v-model="result.state" :on-value="1" :off-value="0">
                                {{ trans('Language is enabled') }}
                            </NSwitch>
                        </NFormItem>

                        <NFormItem class="col--1-1 col--1-2@sm" :label="trans('Hide')" prop="hide">
                            <NSwitch v-model="result.hide" :on-value="1" :off-value="0">
                                {{ trans('Language is hidden') }}
                            </NSwitch>
                        </NFormItem>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-language" :legend="trans('Language')">
                    <div class="grid grid-row grid--wrap grid--20-20">

                        <NFormItem class="col--1-1 col--1-2@sm" :label="trans('Language')" prop="language">
                            <NInput v-model="result.language"></NInput>
                        </NFormItem>

                        <NFormItem class="col--1-1 col--1-2@sm" :label="trans('Country')" prop="country">
                            <NInput v-model="result.country"></NInput>
                        </NFormItem>

                        <NFormItem class="col--1-1 col--1-2@sm" :label="trans('Locale')" prop="locale">
                            <NInput v-model="result.locale"></NInput>
                        </NFormItem>

                        <NFormItem class="col--1-1 col--1-2@sm" :label="trans('Plate')" prop="plate">
                            <NInput v-model="result.plate"></NInput>
                        </NFormItem>

                    </div>
                </NFormGroup>
            </NForm>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoLanguageEdit',

        urls: {
            show: '/{locale}/kyoto/language/http/controllers/language/show',
            update: '/{locale}/kyoto/language/http/controllers/language/update'
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

                let query = {
                    id: this.$route.params.id
                };

                let route = this.Route.get('/{locale}/kyoto/language/http/controllers/language/show',
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
