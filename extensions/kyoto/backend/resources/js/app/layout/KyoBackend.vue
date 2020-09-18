<template>
    <div class="kyo-backend">
        <div class="kyo-header">
            <div class="grid grid--row grid--20">

                <KyoLayoutSubmenu class="col--flex-0-0 col--left">
                    <!-- Submenu -->
                </KyoLayoutSubmenu>

                <KyoLayoutUserpanel class="col--flex-0-0 col--right">
                    <!-- Backenduser -->
                </KyoLayoutUserpanel>

            </div>
        </div>

        <div class="kyo-body full-height-child">
            <router-view />
        </div>

        <div class="kyo-sidebar">
            <KyoLayoutMainmenu>
                <!-- Mainmenu -->
            </KyoLayoutMainmenu>
        </div>

    </div>
</template>
<script>
    export default {

        name: 'KyoBackend',

        data()
        {
            return {
                locale: document.documentElement.lang
            }
        },

        mounted()
        {
            this.$on('locale:change', (val) => this.locale = val);
        },

        watch: {

            'locale': function () {
                this.$emit('locale:changed');
            }

        }

    }
</script>
