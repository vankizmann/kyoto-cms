<template>
    <NLoader v-model="load" class="kyo-installer__body">
        <div class="kyo-installer__introduction">
            <h1>Laravel</h1>
        </div>
        <n-form ref="form" :form="form" :errors="errors">
            <n-form-item label="Application url" prop="APP_URL">
                <n-input v-model="form.APP_URL" placeholder="https://localhost"></n-input>
                <p class="info">
                    Leave if you want to autocomplete the application url
                </p>
            </n-form-item>
            <n-form-item label="Enviroment" prop="APP_ENV">
                <n-switch v-model="form.APP_ENV" on-value="local" off-value="production">Use local enviroment</n-switch>
            </n-form-item>
            <n-form-item label="Reporting" prop="APP_DEBUG">
                <n-switch v-model="form.APP_DEBUG" :on-value="true" :off-value="false">Use debug mode</n-switch>
            </n-form-item>
            <n-form-item label="Application key" prop="APP_KEY">
                <n-input v-model="form.APP_KEY"></n-input>
                <p class="info">
                    Leave if you want to generate a new application key
                </p>
            </n-form-item>
            <n-form-item style="text-align: right; margin-top: 50px;">
                <NButton :disabled="!valid" @click="$router.push('database')">
                    Next step
                </NButton>
            </n-form-item>
        </n-form>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPagesLaravel',

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

                if ( this.Any.isEmpty(this.form.APP_NAME) ) {
                    errors.APP_NAME = this.trans('Name is required!');
                }

                this.errors = errors;
            },

            query()
            {
                this.validate();

                this.$http.post('/web/kyoto/installer/http/controllers/installer/laravel', this.form)
                    .then(() => this.valid = true, () => this.valid = false);
            },

        }

    }
</script>
