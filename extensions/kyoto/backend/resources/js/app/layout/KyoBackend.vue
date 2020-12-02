<template>
    <div class="kyo-backend" :style="backendStyle">
        <div class="kyo-header">
            <div class="grid grid--row grid--30">

                <KyoLayoutSubmenu class="col--flex-0-0 col--left">
                    <!-- Submenu -->
                </KyoLayoutSubmenu>

                <KyoLayoutUserpanel class="col--flex-0-0">
                    <!-- Backenduser -->
                </KyoLayoutUserpanel>

                <KyoLayoutLanguage class="col--flex-0-0">
                    <!-- Language -->
                </KyoLayoutLanguage>

            </div>
        </div>

        <div class="kyo-body full-height-child">
            <router-view />
        </div>

        <div class="kyo-sidebar">

            <div class="kyo-logo">
                <router-link to="/"><span>Kyoto CMS</span></router-link>
            </div>

            <KyoLayoutMainmenu>
                <!-- Mainmenu -->
            </KyoLayoutMainmenu>

            <div class="kyo-logout">
                <a :href="backendPaths.logout"><i class="fa fa-sign-out-alt"></i></a>
            </div>

        </div>

        <NResizer class="kyo-website" :style="websiteStyle" :min-width="minWidth" :max-width="maxWidth" @input="setWidth">
            <KyoLayoutWebsite>
                <!-- Website -->
            </KyoLayoutWebsite>
        </NResizer>

    </div>
</template>
<script>
    export default {

        name: 'KyoBackend',

        computed: {

            backendPaths()
            {
                return window.backendPaths;
            },

            backendStyle()
            {
                return { paddingLeft: this.width + 'px' };
            },

            websiteStyle()
            {
                return { width: this.width + 'px' };
            }

        },

        data()
        {
            return {
                locale: null, width: 270, minWidth: 270, maxWidth: 600
            }
        },

        beforeMount()
        {
            this.locale = document.documentElement.lang;
        },

        mounted()
        {
            Nano.Event.bind('locale:change', (locale) => {
                this.locale = locale;
            });

            Nano.Event.bind('website:resize', (width) => {
                this.width = width;
            });
        },

        watch: {

            'locale': function () {
                Nano.Event.fire('locale:changed');
            },

            'width': function () {
                Nano.Event.fire('website:resized');
            }

        },

        methods: {

            setLocale(locale)
            {
                Nano.Event.fire('localke:change', locale);
            },

            setWidth(width)
            {
                Nano.Event.fire('website:resize', width);
            }

        }

    }
</script>
