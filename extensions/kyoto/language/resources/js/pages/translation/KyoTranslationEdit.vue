<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoTranslations' }" class="col--flex-0-0" @delete="deleteItem">
                <template slot="action">
                    <NButtonGroup>
                        <NButton type="primary" @click="updateItem">
                            {{ trans('Apply') }}
                        </NButton>
                        <NButton type="primary" @click="updateCloseItem">
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
                                    {{ trans('Translation is enabled') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-language" :legend="trans('Translation')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1">
                            <NFormItem :label="trans('Source')" prop="source">
                                <NTextarea :disabled="true" v-model="result.source"></NTextarea>
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

        name: 'KyoTranslationEdit',

        localized: true,

        urls: {
            show: '/{locale}/kyoto/language/http/controllers/translation/show',
            update: '/{locale}/kyoto/language/http/controllers/translation/update',
            delete: '/{locale}/kyoto/language/http/controllers/translation/delete'
        },

        methods: {

            gotoIndex()
            {
                this.$router.push({ name: 'KyoTranslations' });
            }

        },

        extends: window.KyoForm

    }
</script>
