<template>
    <n-form ref="form" :form="form" :errors="errors">
        <n-form-item label="Database" prop="DB_NAME">
            <n-input placeholder="kyoto" v-model="form.DB_NAME"></n-input>
            <p class="info">
                The name of the database you want to use with kyoto
            </p>
        </n-form-item>
        <n-form-item label="User" prop="DB_USERNAME">
            <n-input placeholder="root" v-model="form.DB_USERNAME"></n-input>
            <p class="info">
                The user assigned to your database (Use your root user only for development)
            </p>
        </n-form-item>
        <n-form-item label="Password" prop="DB_PASSWORD">
            <n-input placeholder="root" native-type="password" v-model="form.DB_PASSWORD"></n-input>
            <p class="info">
                The password assigned to your user
            </p>
        </n-form-item>
        <n-form-item label="Host" prop="DB_HOST">
            <n-input placeholder="localhost" v-model="form.DB_HOST"></n-input>
            <p class="info">
                The host for your database (IP or Domain - for socket connection configure your .env without installer)
            </p>
        </n-form-item>
        <n-form-item label="Prefix" prop="DB_PREFIX">
            <n-input placeholder="kyo_" v-model="form.DB_PREFIX"></n-input>
            <p class="info">
                Incase you want to use one database for multiple kyoto installations
            </p>
        </n-form-item>
    </n-form>
</template>
<script>
    export default {

        name: 'KyoTabsDatabase',

        inject: {

            NTabs: {
                default: undefined
            }

        },

        data()
        {
            let form = {
                DB_HOST: 'localhost',
                DB_NAME: 'kyoto',
                DB_USERNAME: 'root',
                DB_PASSWORD: 'root',
                DB_PREFIX: ''
            };

            let errors = {};

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

                if ( this.Any.isEmpty(this.form.DB_NAME) ) {
                    errors.DB_NAME = this.trans('Database is required!');
                }

                if ( this.Any.isEmpty(this.form.DB_USERNAME) ) {
                    errors.DB_USERNAME = this.trans('User is required!');
                }

                if ( this.Any.isEmpty(this.form.DB_HOST) ) {
                    errors.DB_HOST = this.trans('Host is required!');
                }

                this.errors = errors;
            },

            testQuery()
            {
                this.testValidate();

                this.$http.post('/web/kyoto/installer/http/controllers/installer/database', this.form)
                    .then(this.testDone, this.testError);
            },

            testDone()
            {
                this.Event.fire('DB_ERROR', false);
            },

            testError()
            {
                this.Event.fire('DB_ERROR', true);
            }

        }
    }
</script>
