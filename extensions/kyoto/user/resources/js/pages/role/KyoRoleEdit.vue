<template>
    <NLoader :visible="load">
        <NScrollbar class="full-height grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoRoles' }" class="col--flex-0-0" @delete="deleteItem">
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

                <NFormGroup icon="fa fa-paragraph" :label="trans('Info')">
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

                <NFormGroup icon="fa fa-user-shield" :label="trans('Access')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1">
                            <NFormItem :label="trans('Policies')" prop="policies">
                                <KyoPolicyTransfer v-model="result.policies"></KyoPolicyTransfer>
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

        name: 'KyoRoleEdit',

        localized: false,

        urls: {
            show: '/{locale}/kyoto/user/http/controllers/role/show',
            update: '/{locale}/kyoto/user/http/controllers/role/update',
            delete: '/{locale}/kyoto/user/http/controllers/role/delete'
        },

        methods: {

            gotoIndex()
            {
                this.$router.push({ name: 'KyoRoles' });
            }

        },

        extends: window.KyoForm

    }
</script>
