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

        <NModal v-model="modal" :selector="false" width="auto">
            <div class="grid grid--col grid--center grid--20-20">
                <div class="col col--auto">
                    {{ this.trans('Enable system mode?') }}
                </div>
                <div class="col col--auto">
                    <NButton type="primary" @click="enableMode">
                        {{ trans('Enable')}}
                    </NButton>
                    <NButton type="secondary" @click="disableMode">
                        {{ trans('Disable')}}
                    </NButton>
                </div>
            </div>
        </NModal>

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
                locale: null, modal: false, width: 330, minWidth: 270, maxWidth: 600, strokeCache: []
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

            Nano.Dom.find(window).on('keyup', this.eventKeyup);
            Nano.Dom.find(window).on('keydown', this.eventKeydown);
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
            },

            eventKeydown(event)
            {
                Nano.Arr.add(this.strokeCache, event.which);

                if ( ! Nano.Arr.contains(this.strokeCache, [18, 79]) ) {
                    return;
                }

                this.modal = true;
            },

            eventKeyup(event)
            {
                Nano.Arr.remove(this.strokeCache, event.which);
            },

            enableMode()
            {
                Nano.Cookie.set('kyoto_sysmode', '1');

                window.location.reload();
            },

            disableMode()
            {
                Nano.Cookie.set('kyoto_sysmode', '0');

                window.location.reload();
            }

        }

    }
</script>
