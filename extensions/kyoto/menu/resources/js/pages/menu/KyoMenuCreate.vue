<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoLanguages' }" class="col--flex-0-0">
                <template slot="action">
                    <NButtonGroup>
                        <NButton type="primary" @click="storeItem">
                            {{ trans('Apply') }}
                        </NButton>
                        <NButton type="primary" @click="storeItemClose">
                            {{ trans('Save') }}
                        </NButton>
                    </NButtonGroup>
                </template>
            </KyoTitlebar>

            <NForm :form="result" :errors="errors" class="kyo-dataform col--flex-1-0">

                <NFormGroup icon="fa fa-cog" :legend="trans('Settings')">

                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('State')" prop="state">
                                <NSwitch v-model="result.state" :on-value="1" :off-value="0">
                                    {{ trans('Menu is enabled') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Hide')" prop="hide">
                                <NSwitch v-model="result.hide" :on-value="1" :off-value="0">
                                    {{ trans('Menu is hidden') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-compass" :legend="trans('Menu')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Title')" prop="title">
                                <NInput v-model="result.title"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Slug')" prop="slug">
                                <NInput v-model="result.slug"></NInput>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NConfig :value="result.option" :config="config" :scope="{}"></NConfig>

            </NForm>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoLanguageCreate',

        localized: true,

        urls: {
            show: '/{locale}/kyoto/language/http/controllers/language/show',
            store: '/{locale}/kyoto/language/http/controllers/language/store'
        },

        computed: {

            config()
            {
                if ( Nano.Any.isEmpty(this.result.type) ) {
                    return {};
                }

                if ( ! Nano.Data.has(this.result.type) ) {
                    return {};
                }

                return Nano.Data.get(this.result.type);
            }

        },

        methods: {

            gotoEdit(row)
            {
                this.$router.push({
                    name: 'KyoLanguageEdit', params: row.data
                });

                console.log(row.data);
            },

            gotoIndex()
            {
                this.$router.push({
                    name: 'KyoLanguages'
                });
            }

        },

        extends: window.KyoForm

    }
</script>
