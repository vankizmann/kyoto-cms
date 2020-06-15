<template>
    <NLoader v-model="load" class="kyo-installer__body">
        <div class="kyo-installer__introduction">
            <h1>Website</h1>
        </div>
        <n-form ref="form" :form="form" :errors="errors">
            <n-form-item label="Website title" prop="KYO_TITLE">
                <n-input placeholder="My Website" v-model="form.KYO_TITLE"></n-input>
                <p class="info">
                    The title of your website
                </p>
            </n-form-item>
            <n-form-item label="Admin name" prop="KYO_USERNAME">
                <n-input placeholder="admin" v-model="form.KYO_USERNAME"></n-input>
            </n-form-item>
            <n-form-item label="Admin password" prop="KYO_PASSWORD">
                <n-input native-type="password" v-model="form.KYO_PASSWORD"></n-input>
            </n-form-item>
            <n-form-item label="Admin email" prop="KYO_EMAIL">
                <n-input placeholder="your@email.com" v-model="form.KYO_EMAIL"></n-input>
                <p class="info">
                    Your E-Mail address to recover your admin user
                </p>
            </n-form-item>
            <n-form-item style="text-align: right; margin-top: 50px;">
                <NButton type="secondary" @click="$router.push('database')">
                    Previous step
                </NButton>
                <NButton :disabled="!valid" @click="$router.push('setup')">
                    Next step
                </NButton>
            </n-form-item>
        </n-form>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPagesWebsite',

        data()
        {
            return { form: {}, errors: {}, valid: false, load: true };
        },

        beforeMount()
        {
            this.initialize();
        },

        mounted()
        {
            this.$refs.form.$on('change', this.Any.debounce(this.query, 500));
        },

        methods: {

            initialize()
            {
                let opts = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false,
                };

                this.$http.get('/kyoto/installer/http/controllers/installer/env', opts)
                    .then((res) => this.form = res.data, () => window.location.reload());
            },

            validate()
            {
                let errors = {};

                if ( this.Any.isEmpty(this.form.KYO_TITLE) ) {
                    errors.KYO_TITLE = this.trans('Title is required!');
                }

                if ( this.Any.isEmpty(this.form.KYO_USERNAME) || ! this.form.KYO_USERNAME.match(/^.{3,}$/) ) {
                    errors.KYO_USERNAME = this.trans('User is required and must contain at least 3 chars!');
                }

                if ( this.Any.isEmpty(this.form.KYO_PASSWORD) || ! this.form.KYO_PASSWORD.match(/^.{6,}$/) ) {
                    errors.KYO_PASSWORD = this.trans('Password is required and must contain at least 6 chars!');
                }

                if ( this.Any.isEmpty(this.form.KYO_EMAIL) || ! this.form.KYO_EMAIL.match(/^[^@]+@[^.]{2,}\.[A-Za-z]{2,}$/) ) {
                    errors.KYO_EMAIL = this.trans('Email is required and must be valid!');
                }

                this.errors = errors;
            },

            query()
            {
                this.validate();

                this.$http.post('/kyoto/installer/http/controllers/installer/website', this.form)
                    .then(() => this.valid = true, () => this.valid = false);
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
