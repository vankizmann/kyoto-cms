<template>
    <router-view></router-view>
</template>
<script>
    export default {

        name: 'KyoInstaller',

        data()
        {
            return {
                LV_STATUS: false,
                DB_STATUS: false,
                KY_STATUS: false
            };
        },

        mounted()
        {
            // this.Event.bind('LV_ERROR', (res) => {
            //     this.$refs.LV_STATUS.setValue(!res);
            // });
            //
            // this.Event.bind('DB_ERROR', (res) => {
            //     this.$refs.DB_STATUS.setValue(!res);
            // });
            //
            // this.Event.bind('KY_ERROR', (res) => {
            //     this.$refs.KY_STATUS.setValue(!res);
            // });
        }

    }
</script>
