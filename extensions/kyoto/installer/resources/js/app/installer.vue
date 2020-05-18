<template>
    <div>
        <div class="kyo-installer__introduction">
            <h1>Enviroment</h1>
            <p>Basic configuration to prepare for final installation</p>
        </div>
        <n-tabs ref="tabs">
            <n-tabs-item name="default" :label="trans('Laravel')" :keep-alive="true" :preload="true">
                <kyo-element-status ref="LV_STATUS" slot="label" v-model="LV_STATUS">
                    <span>{{ trans('Laravel') }}</span> <span slot="info">{{ trans('State of laravel configuration') }}</span>
                </kyo-element-status>
                <kyo-tabs-laravel>
                    <!-- LARAVEL CONFIG -->
                </kyo-tabs-laravel>
            </n-tabs-item>
            <n-tabs-item name="database" :label="trans('Database')" :keep-alive="true" :preload="true">
                <kyo-element-status ref="DB_STATUS" slot="label" v-model="DB_STATUS">
                    <span>{{ trans('Database') }}</span> <span slot="info">{{ trans('State of database configuration') }}</span>
                </kyo-element-status>
                <kyo-tabs-database>
                    <!-- DATABASE CONFIG -->
                </kyo-tabs-database>
            </n-tabs-item>
            <n-tabs-item name="website" :label="trans('Website')" :keep-alive="true" :preload="true">
                <kyo-element-status ref="KY_STATUS" slot="label" v-model="KY_STATUS">
                    <span>{{ trans('Website') }}</span> <span slot="info">{{ trans('State of website configuration') }}</span>
                </kyo-element-status>
                <kyo-tabs-website>
                    <!-- WEBSITE CONFIG -->
                </kyo-tabs-website>
            </n-tabs-item>
        </n-tabs>
    </div>
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
            this.Event.bind('LV_ERROR', (res) => {
                this.$refs.LV_STATUS.setValue(!res);
            });

            this.Event.bind('DB_ERROR', (res) => {
                this.$refs.DB_STATUS.setValue(!res);
            });

            this.Event.bind('KY_ERROR', (res) => {
                this.$refs.KY_STATUS.setValue(!res);
            });
        }

    }
</script>
