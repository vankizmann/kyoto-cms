<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoGates' }" class="col--flex-0-0">
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

                <NFormGroup icon="fa fa-paragraph" :legend="trans('Info')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1">
                            <NFormItem :label="trans('Title')" prop="title">
                                <NInput v-model="result.title"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1">
                            <NFormItem :label="trans('Description')" prop="description">
                                <NTextarea v-model="result.description" :min-rows="2" :auto-rows="true"></NTextarea>
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

        name: 'KyoGateCreate',

        localized: false,

        urls: {
            show: '/{locale}/kyoto/user/http/controllers/gate/show',
            store: '/{locale}/kyoto/user/http/controllers/gate/store'
        },

        methods: {

            gotoEdit(row)
            {
                this.$router.push({
                    name: 'KyoGateEdit', params: row.data
                });
            },

            gotoIndex()
            {
                this.$router.push({
                    name: 'KyoGates'
                });
            }

        },

        extends: window.KyoForm

    }
</script>
