<template>
    <NLoader :visible="load">
        <NScrollbar class="full-height grid grid--col">

            <KyoTitlebar :back="true" class="col--flex-0-0" @delete="deleteItem">
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

                <div v-if="result.view">
                    <img :src="result.url" alt="">
                </div>

                <NFormGroup icon="fa fa-info" :label="trans('Info')">
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

        </NScrollbar>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoMediaEdit',

        extends: window.KyoForm,

        localized: true,

        urls: {
            show: '/{locale}/kyoto/media/http/controllers/media/show',
            update: '/{locale}/kyoto/media/http/controllers/media/update',
            delete: '/{locale}/kyoto/media/http/controllers/media/delete'
        },

        methods: {

            gotoIndex()
            {
                this.$router.go(-1);
            }

        }

    }
</script>
