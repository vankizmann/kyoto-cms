<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoPolicies' }" class="col--flex-0-0" @delete="deleteItem">
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

                <NFormGroup icon="fa fa-user-shield" :legend="trans('Policy')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1">
                            <NFormItem :label="trans('Title')" prop="title">
                                <NInput v-model="result.title"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1">
                            <NFormItem :label="trans('Type')" prop="type">
                                <NInput v-model="result.type"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1">
                            <NFormItem :label="trans('Action')" prop="action">
                                <NInput v-model="result.action"></NInput>
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

        name: 'KyoPolicyEdit',

        localized: false,

        urls: {
            show: '/{locale}/kyoto/user/http/controllers/policy/show',
            update: '/{locale}/kyoto/user/http/controllers/policy/update',
            delete: '/{locale}/kyoto/user/http/controllers/policy/delete'
        },

        methods: {

            gotoIndex()
            {
                this.$router.push({ name: 'KyoPolicies' });
            }

        },

        extends: window.KyoForm

    }
</script>
