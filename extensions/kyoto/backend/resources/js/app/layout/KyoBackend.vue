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
                <a ><i class="fa fa-sign-out-alt"></i></a>
            </div>

        </div>

        <NResizer v-show="website" class="kyo-website" :style="websiteStyle" :min-width="minWidth" :max-width="maxWidth" @update:modelValue="setWidth">
            <KyoLayoutWebsite>
                <!-- Website -->
            </KyoLayoutWebsite>
        </NResizer>

        <NModal v-model="modal" :listen="false" width="auto">
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
                let style = {
                    paddingLeft: this.width + 'px'
                };

                if ( ! this.website ) {
                    style.paddingLeft = 0;
                }

                return style;
            },

            websiteStyle()
            {
                let style = {
                    width: this.width + 'px'
                };

                if ( ! this.website ) {
                    style.width = 0;
                }

                return style;
            }

        },

        data()
        {
            return {
                locale: null, modal: false, website: true, width: 330, minWidth: 270, maxWidth: 600, strokeCache: []
            }
        },

        beforeMount()
        {
            this.locale = document.documentElement.lang;
        },

        mounted()
        {
            console.log(this)
            this.$watch('locale', () => {
                Nano.Event.fire('locale:changed');
            });

            this.$watch('width', () => {
                Nano.Event.fire('website:resized');
            });

            Nano.Event.bind('locale:change', (locale) => {
                this.locale = locale;
            });

            Nano.Event.bind('website:resize', (width) => {
                this.width = width;
            });

            Nano.Dom.find(window).on('keyup', this.eventKeyup);
            Nano.Dom.find(window).on('keydown', this.eventKeydown);
        },

        methods: {

            showWebsite()
            {
                this.website = true;
            },

            hideWebsite()
            {
                this.website = false;
            },

            setLocale(locale)
            {
                Nano.Event.fire('locale:change', locale);
            },

            setWidth(width)
            {
                Nano.Event.fire('website:resize', width);

console.log('biereschiss');
                Nano.Dom.find(window).fire('resize')
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
