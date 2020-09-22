<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoLanguages' }" class="col--flex-0-0">
                <template slot="action">
                    <NButtonGroup>
                        <NButton type="primary" @click="updateItem">
                            {{ trans('Apply') }}
                        </NButton>
                        <NButton type="primary" @click="updateItem">
                            {{ trans('Save') }}
                        </NButton>
                    </NButtonGroup>
                </template>
            </KyoTitlebar>
            
            <NForm :form="value" :errors="errors" class="kyo-dataform col--flex-1-0">

                <NFormGroup icon="fa fa-cog" :legend="trans('Settings')">

                    <div class="grid grid-row grid--wrap grid--20-20">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('State')" prop="state">
                                <NSwitch v-model="value.state" :on-value="1" :off-value="0">
                                    {{ trans('Language is enabled') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Hide')" prop="hide">
                                <NSwitch v-model="value.hide" :on-value="1" :off-value="0">
                                    {{ trans('Language is hidden') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-language" :legend="trans('Language')">
                    <div class="grid grid-row grid--wrap grid--20-20">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Language')" prop="language">
                                <NInput v-model="value.language"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Country')" prop="country">
                                <NInput v-model="value.country"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Locale')" prop="locale">
                                <NInput v-model="value.locale"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Plate')" prop="plate">
                                <NInput v-model="value.plate"></NInput>
                            </NFormItem>
                        </div>

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
                value: {}, errors: {}, load: true
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

                this.$http.get(route, options).then(this.queryDone, () => null);
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

                let route = this.Route.get('/{locale}/kyoto/language/http/controllers/language/update',
                    this.$root.$data, query);

                this.$http.post(route, this.value, options).then(this.queryDone, this.queryError);
            },

            queryDone(res)
            {
                this.value = Nano.Obj.get(res.data, 'data', {});
            },

            queryError(res)
            {
                this.errors = Nano.Obj.get(res.data, 'errors', {});
            },

            deleteItem()
            {
                console.log('DELETE ITEMS');
            }

        }

    }
</script>
