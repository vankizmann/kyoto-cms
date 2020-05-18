<template>
    <n-form ref="form" :form="form" :errors="errors">
        <n-form-item label="Name" prop="APP_NAME">
            <n-input placeholder="kyoto" v-model="form.APP_NAME"></n-input>
            <p class="info">
                The name of your application
            </p>
        </n-form-item>
        <n-form-item label="Enviroment" prop="APP_LOCAL">
            <n-switch v-model="form.APP_LOCAL">Enable local mode</n-switch>
            <p class="info">
                Leave like this for production or if you dont know what this is
            </p>
        </n-form-item>
        <n-form-item label="Debug" prop="APP_DEBUG">
            <n-switch v-model="form.APP_DEBUG">Enable debug mode</n-switch>
            <p class="info">
                 Leave like this for production or if you dont know what this is
            </p>
        </n-form-item>
        <n-form-item label="URL" prop="APP_URL">
            <n-input v-model="form.APP_URL" placeholder="https://localhost"></n-input>
            <p class="info">
                Leave like this for auto detection or paste your target url
            </p>
        </n-form-item>
        <n-form-item label="Key" prop="APP_KEY">
            <n-input v-model="form.APP_KEY"></n-input>
            <p class="info">
                Leave if you dont know what this is
            </p>
        </n-form-item>
    </n-form>
</template>
<script>
    export default {

        name: 'KyoTabsLaravel',

        inject: {

            NTabs: {
                default: undefined
            }

        },

        data()
        {
            let form = {
                APP_NAME: 'kyoto',
                APP_LOCAL: false,
                APP_DEBUG: false,
                APP_KEY: '',
                APP_URL: ''
            };

            let errors = {}

            return { form, errors };
        },

        beforeMount()
        {
            this.testValidate();
        },

        mounted()
        {
            this.$refs.form.$on('change',
                this.Any.debounce(this.testQuery, 500));

            this.NTabs.$on('hook:mounted', this.testQuery);
        },

        methods: {

            testValidate()
            {
                let errors = {};

                if ( this.Any.isEmpty(this.form.APP_NAME) ) {
                    errors.APP_NAME = this.trans('Name is required!');
                }

                this.errors = errors;
            },

            testQuery()
            {
                this.testValidate();

                this.$http.post('/web/kyoto/installer/http/controllers/installer/laravel', this.form)
                    .then(this.testDone, this.testError);
            },

            testDone()
            {
                this.Event.fire('LV_ERROR', false);
            },

            testError()
            {
                this.Event.fire('LV_ERROR', true);
            }

        }

    }
</script>
