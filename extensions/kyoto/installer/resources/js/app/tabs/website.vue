<template>
    <n-form ref="form" :form="form" :errors="errors">
        <n-form-item label="Title" prop="KYO_TITLE">
            <n-input placeholder="My Website" v-model="form.KYO_TITLE"></n-input>
            <p class="info">
                The title of your website
            </p>
        </n-form-item>
        <n-form-item label="User" prop="KYO_USER">
            <n-input placeholder="admin" v-model="form.KYO_USER"></n-input>
            <p class="info">
                The admin username (Needed for login)
            </p>
        </n-form-item>
        <n-form-item label="Password" prop="KYO_PASS">
            <n-input native-type="password" v-model="form.KYO_PASS"></n-input>
            <p class="info">
                The admin password (Needed for login)
            </p>
        </n-form-item>
        <n-form-item label="E-Mail" prop="KYO_MAIL">
            <n-input placeholder="your@email.com" v-model="form.KYO_MAIL"></n-input>
            <p class="info">
                Your E-Mail address to recover your admin user
            </p>
        </n-form-item>
    </n-form>
</template>
<script>
    export default {

        name: 'KyoTabsWebsite',

        inject: {

            NTabs: {
                default: undefined
            }

        },

        data()
        {
            let form = {
                KYO_TITLE: '',
                KYO_USER: '',
                KYO_PASS: '',
                KYO_MAIL: '',
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

                if ( this.Any.isEmpty(this.form.KYO_TITLE) ) {
                    errors.KYO_TITLE = this.trans('Title is required!');
                }

                if ( this.Any.isEmpty(this.form.KYO_USER) || ! this.form.KYO_USER.match(/^.{3,}$/) ) {
                    errors.KYO_USER = this.trans('User is required and must be at contain at least 3 chars!');
                }

                if ( this.Any.isEmpty(this.form.KYO_PASS) || ! this.form.KYO_PASS.match(/^.{6,}$/) ) {
                    errors.KYO_PASS = this.trans('Password is required and must be at contain at least 6 chars!');
                }

                if ( this.Any.isEmpty(this.form.KYO_MAIL) || ! this.form.KYO_MAIL.match(/^[^@]+@[^.]{2,}\.[A-Za-z]{2,}$/) ) {
                    errors.KYO_MAIL = this.trans('Email is required and must be valid!');
                }

                this.errors = errors;
            },

            testQuery()
            {
                this.testValidate();

                this.$http.post('/web/kyoto/installer/http/controllers/installer/website', this.form)
                    .then(this.testDone, this.testError);
            },

            testDone()
            {
                this.Event.fire('KY_ERROR', false);
            },

            testError()
            {
                this.Event.fire('KY_ERROR', true);
            }

        }

    }
</script>
