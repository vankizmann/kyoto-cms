<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoUsers' }" class="col--flex-0-0" @delete="deleteItem">
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
                                    {{ trans('User is enabled') }}
                                </NSwitch>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-user" :legend="trans('User')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Name')" prop="name">
                                <NInput v-model="result.name"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('E-Mail')" prop="email">
                                <NInput v-model="result.email"></NInput>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-user-shield" :legend="trans('Access')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Role')" prop="role_id">
                                <KyoRoleSelect v-model="result.role_id"></KyoRoleSelect>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Gate')" prop="gate_id">
                                <KyoGateSelect v-model="result.gate_id"></KyoGateSelect>
                            </NFormItem>
                        </div>

                    </div>
                </NFormGroup>

                <NFormGroup icon="fa fa-key" :legend="trans('Security')">
                    <div class="grid grid-row grid--wrap grid--30">

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Password')" prop="fooword">
                                <NInput v-model="result.fooword"></NInput>
                            </NFormItem>
                        </div>

                        <div class="col--1-1 col--1-2@sm">
                            <NFormItem :label="trans('Password confirmation')" prop="fooword_confirm">
                                <NInput v-model="result.fooword_confirm"></NInput>
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

        name: 'KyoUserEdit',

        localized: false,

        urls: {
            show: '/{locale}/kyoto/user/http/controllers/user/show',
            update: '/{locale}/kyoto/user/http/controllers/user/update',
            delete: '/{locale}/kyoto/user/http/controllers/user/delete'
        },

        methods: {

            gotoIndex()
            {
                this.$router.push({ name: 'KyoUsers' });
            }

        },

        extends: window.KyoForm

    }
</script>
