<template>
    <div class="kyo-backend">
        <div class="kyo-header">
            <div class="grid grid--row grid--20">

                <KyoLayoutSubmenu class="kyo-submenu col--flex-0-0 col--left">
                    <!-- Submenu -->
                </KyoLayoutSubmenu>

                <KyoLayoutUserpanel class="kyo-userpanel col--flex-0-0 col--right">
                    <!-- Backenduser -->
                </KyoLayoutUserpanel>

            </div>
        </div>

        <div class="kyo-body full-height-child">
            <router-view />
        </div>

        <div class="kyo-sidebar">
            <KyoLayoutMainmenu class="kyo-mainmenu">
                <!-- Mainmenu -->
            </KyoLayoutMainmenu>
            <KyoLayoutLanguage class="kyo-backend__language">
                <!-- Language -->
            </KyoLayoutLanguage>
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
