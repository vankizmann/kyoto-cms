<template>
    <NLoader v-model="load" class="kyo-installer__body">
        <div class="kyo-installer__introduction">
            <h1>Database</h1>
        </div>
        <n-form ref="form" :form="form" :errors="errors">
            <n-form-item label="Database name" prop="DB_DATABASE">
                <n-input placeholder="laravel" v-model="form.DB_DATABASE"></n-input>
            </n-form-item>
            <n-form-item label="Database user" prop="DB_USERNAME">
                <n-input placeholder="root" v-model="form.DB_USERNAME"></n-input>
            </n-form-item>
            <n-form-item label="Database password" prop="DB_PASSWORD">
                <n-input placeholder="root" native-type="password" v-model="form.DB_PASSWORD"></n-input>
            </n-form-item>
            <n-form-item label="Database host" prop="DB_HOST">
                <n-input placeholder="localhost" v-model="form.DB_HOST"></n-input>
                <p class="info">
                    The host for your database (IP or Domain - for socket connection configure your .env without installer)
                </p>
            </n-form-item>
            <n-form-item label="Databse prefix" prop="DB_PREFIX">
                <n-input placeholder="kyo_" v-model="form.DB_PREFIX"></n-input>
                <p class="info">
                    Incase you want to use one database for multiple kyoto installations
                </p>
            </n-form-item>
            <n-form-item style="text-align: right; margin-top: 50px;">
                <NButton type="secondary" @click="$router.push('laravel')">
                    Previous step
                </NButton>
                <NButton :disabled="!valid" @click="$router.push('website')">
                    Next step
                </NButton>
            </n-form-item>
        </n-form>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPagesDatabase',

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

                this.$http.get('/web/kyoto/installer/http/controllers/installer/env', opts)
                    .then((res) => this.form = res.data, () => window.location.reload());
            },

            validate()
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

            query()
            {
                this.validate();

                this.$http.post('/web/kyoto/installer/http/controllers/installer/database', this.form)
                    .then(() => this.valid = true, () => this.valid = false);
            }

        }
    }
</script>
