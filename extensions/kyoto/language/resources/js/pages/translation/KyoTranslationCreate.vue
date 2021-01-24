<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoTranslations' }" class="col--flex-0-0">
                <template v-slot:action>
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

                <NFormGroup icon="fa fa-cog" :label="trans('Settings')">

                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('State')" prop="state">
                                <NSwitch v-model="result.state" :on-value="1" :off-value="0">
                                    {{ trans('Translation is enabled') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-language" :label="trans('Translation')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1">
                            <NFormItem :label="trans('Source')" prop="source">
                                <NTextarea v-model="result.source"></NTextarea>
                            </NFormItem>
                        </div>

                        <div class="col--1-1">
                            <NFormItem :label="trans('Target')" prop="target">
                                <NTextarea v-model="result.target"></NTextarea>
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

        name: 'KyoTranslationCreate',

        localized: true,

        urls: {
            show: '/{locale}/kyoto/language/http/controllers/translation/show',
            store: '/{locale}/kyoto/language/http/controllers/translation/store'
        },

        methods: {

            gotoEdit(row)
            {
                this.$router.push({
                    name: 'KyoTranslationEdit', params: row.data
                });
            },

            gotoIndex()
            {
                this.$router.push({
                    name: 'KyoTranslations'
                });
            }

        },

        extends: window.KyoForm

    }
</script>
