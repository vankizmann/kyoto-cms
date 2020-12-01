<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoPages' }" class="col--flex-0-0" @delete="deleteItem">
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
                                    {{ trans('Page is enabled') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Hide')" prop="hide">
                                <NSwitch v-model="result.hide" :on-value="1" :off-value="0">
                                    {{ trans('Page is hidden') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-page" :legend="trans('Page')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1">
                            <NFormItem :label="trans('Title')" prop="title">
                                <NInput v-model="result.title"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1">
                            <NFormItem :label="trans('Content')" prop="content">
                                <NTextarea v-model="result.content"></NTextarea>
                            </NFormItem>
                        </div>

                        <div class="col--1-1">
                            <KyoPageBuilder v-model="result"></KyoPageBuilder>
                        </div>

                    </div>
                </NFormGroup>

            </NForm>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPageEdit',

        localized: true,

        urls: {
            show: '/{locale}/kyoto/page/http/controllers/page/show',
            update: '/{locale}/kyoto/page/http/controllers/page/update',
            delete: '/{locale}/kyoto/page/http/controllers/page/delete'
        },

        methods: {

            gotoIndex()
            {
                this.$router.push({ name: 'KyoPages' });
            }

        },

        extends: window.KyoForm

    }
</script>
