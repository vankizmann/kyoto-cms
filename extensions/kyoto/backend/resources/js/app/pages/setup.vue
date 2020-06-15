<template>
    <NLoader v-model="load" class="kyo-installer__body">
        <div class="kyo-installer__introduction">
            <h1>Finish</h1>
            <p>Your website is now ready for further information check out the <a href="#" target="_blank">help for users</a> or the <a href="#" target="_blank">documentation for developers</a>.</p>
        </div>
        <div class="kyo-installer__finish">
            <NButton type="secondary" native-type="a" target="_blank" href="../">
                Start using your website
            </NButton>
            <NButton native-type="a" target="_blank" href="../backend">
                Backend login
            </NButton>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPagesSetup',

        data()
        {
            return { form: {}, errors: {}, load: true };
        },

        beforeMount()
        {
            this.initialize();
        },

        methods: {

            initialize()
            {
                let opts = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false,
                };

                this.$http.get('/kyoto/installer/http/controllers/installer/setup', opts)
                    .then((res) => this.form = res.data, () => null);
            },

        }

    }
</script>
