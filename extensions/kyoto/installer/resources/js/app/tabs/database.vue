<template>
    <n-form ref="form" :form="form">
        <n-form-item>
            <n-button :type="status === 'OK' ? 'success' : 'danger'" style="width: 100%;">Status</n-button>
        </n-form-item>
        <n-form-item label="Name">
            <n-input placeholder="kyoto" v-model="form.DB_NAME"></n-input>
            <p class="info">
                The name of the database you want to use with kyoto
            </p>
        </n-form-item>
        <n-form-item label="User">
            <n-input placeholder="root" v-model="form.DB_USERNAME"></n-input>
            <p class="info">
                The user assigned to your database (Use your root user only for development)
            </p>
        </n-form-item>
        <n-form-item label="Password">
            <n-input placeholder="root" native-type="password" v-model="form.DB_PASSWORD"></n-input>
            <p class="info">
                The password assigned to your user
            </p>
        </n-form-item>
        <n-form-item label="Host">
            <n-input placeholder="localhost" v-model="form.DB_HOST"></n-input>
            <p class="info">
                The host for your database (IP or Domain - for socket connection configure your .env without installer)
            </p>
        </n-form-item>
        <n-form-item label="Prefix">
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

        data()
        {
            let form = {
                DB_HOST: 'localhost',
                DB_NAME: 'kyoto',
                DB_USERNAME: 'root',
                DB_PASSWORD: 'root',
                DB_PREFIX: ''
            };

            return { status: 'ERROR', form };
        },

        mounted()
        {
            this.$refs.form.$on('change',
                this.Any.debounce(this.test, 500));

            this.test();
        },

        methods: {

            test()
            {
                let url = '/web/kyoto/installer/http/controllers/installer/database';

                this.$http.post(url, this.form).then(this.testDone, this.testError);
            },

            testDone()
            {
                this.status = 'OK';
            },

            testError()
            {
                this.status = 'ERROR';
            }

        }
    }
</script>
