<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoLanguages' }" class="col--flex-0-0" @delete="deleteItem">
                <template v-slot:action>
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

                <NFormGroup icon="fa fa-cog" :label="trans('Settings')">

                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('State')" prop="state">
                                <NSwitch v-model="result.state" :on-value="1" :off-value="0">
                                    {{ trans('Language is enabled') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Hide')" prop="hide">
                                <NSwitch v-model="result.hide" :on-value="1" :off-value="0">
                                    {{ trans('Language is hidden') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-language" :label="trans('Language')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Language')" prop="language">
                                <NInput v-model="result.language"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Country')" prop="country">
                                <NInput v-model="result.country"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Locale')" prop="locale">
                                <NInput v-model="result.locale"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Plate')" prop="plate">
                                <NInput v-model="result.plate"></NInput>
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

        localized: true,

        urls: {
            show: '/{locale}/kyoto/language/http/controllers/language/show',
            update: '/{locale}/kyoto/language/http/controllers/language/update',
            delete: '/{locale}/kyoto/language/http/controllers/language/delete'
        },

        methods: {

            gotoIndex()
            {
                this.$router.push({ name: 'KyoLanguages' });
            }

        },

        extends: window.KyoForm

    }
</script>
