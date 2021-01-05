<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :back="true" class="col--flex-0-0">
                <template slot="action">
                    <NButtonGroup>
                        <NButton type="primary" @click="storeItemClose">
                            {{ trans('Save') }}
                        </NButton>
                    </NButtonGroup>
                </template>
            </KyoTitlebar>

            <NForm :form="result" :errors="errors" class="kyo-dataform col--flex-1-0">

                <NFormGroup icon="fa fa-info" :legend="trans('Info')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1">
                            <NFormItem :label="trans('Title')" prop="title">
                                <NInput v-model="result.title"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@md">
                            <NFormItem :label="trans('Description')" prop="description">
                                <NTextarea v-model="result.description"></NTextarea>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@md">
                            <NFormItem :label="trans('Copyright')" prop="copyright">
                                <NTextarea v-model="result.copyright"></NTextarea>
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

        name: 'KyoMediaCreate',

        localized: true,

        urls: {
            show: '/{locale}/kyoto/media/http/controllers/media/show',
            store: '/{locale}/kyoto/media/http/controllers/media/store'
        },

        mounted()
        {
            this.override.parent_id = window.location.hash.replace(/^#/, '');
        },

        methods: {

            gotoIndex()
            {
                this.$router.go(-1);
            }

        },

        extends: window.KyoForm

    }
</script>
