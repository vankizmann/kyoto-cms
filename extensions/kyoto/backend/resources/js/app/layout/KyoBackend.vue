<template>
    <div class="kyo-backend">

        <div class="kyo-navigation">

            <div class="kyo-navigation__notify">
                <a href="javascript:void(0)">
                    <img src="/extensions/kyoto/backend/img/kyoto-image.svg" alt="kyoto cms">
                </a>
            </div>

            <div class="kyo-navigation__logo">
                <router-link to="/">
                    <img src="/extensions/kyoto/backend/img/kyoto.svg" alt="kyoto cms">
                </router-link>
            </div>

            <div class="kyo-navigation__menu">
                <KyoLayoutMainmenu></KyoLayoutMainmenu>
            </div>

            <div v-if="false" class="kyo-navigation__menu">
                <KyoLayoutSubmenu></KyoLayoutSubmenu>
            </div>

            <div class="kyo-navigation__dash">
                <KyoLayoutDash></KyoLayoutDash>
            </div>

            <div class="kyo-navigation__language">
                <KyoLayoutLanguage></KyoLayoutLanguage>
            </div>

        </div>

        <div class="kyo-body">
            <router-view />
        </div>

        <NResizer v-show="website" class="kyo-website" :min-width="minWidth" :max-width="maxWidth" @update:modelValue="setWidth">
            <KyoWebsite>
                <!-- Website -->
            </KyoWebsite>
        </NResizer>

        <NModal v-model="modal" :listen="false" width="auto">
            <div class="grid grid--col grid--center grid--20-20">
                <div class="col col--auto">
                    {{ this.trans('Enable system mode?') }}
                </div>
                <div class="col col--auto">
                    <NButton type="warning" @click="enableMode">
                        {{ trans('Enable')}}
                    </NButton>
                    <NButton type="primary" @click="disableMode">
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

            logout()
            {
                return kyoto.paths.logout;
            },

            backendPaths()
            {
                return window.backendPaths;
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
            kyoto.addDash({
                type: 'tree',
                title: this.trans('Show menu tree'),
                description: this.trans('Force the visibility of menu tree'),
                keys: ['tree', 'show', 'menu'],
                callback: this.showWebsite
            });

            kyoto.addDash({
                type: 'tree',
                title: this.trans('Hide menu tree'),
                description: this.trans('Force the visibility of menu tree'),
                keys: ['tree', 'hide', 'menu'],
                callback: this.hideWebsite
            });

            this.$watch('locale', () => {
                pi.Event.fire('locale:changed');
            });

            this.$watch('width', () => {
                pi.Event.fire('website:resized');
            });

            pi.Event.bind('locale:change', (locale) => {
                this.locale = locale;
            });

            pi.Event.bind('website:resize', (width) => {
                this.width = width;
            });

            pi.Dom.find(window).on('keyup', this.eventKeyup);
            pi.Dom.find(window).on('keydown', this.eventKeydown);
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
                pi.Event.fire('locale:change', locale);
            },

            setWidth(width)
            {
                pi.Event.fire('website:resize', width);

                pi.Dom.find(window).fire('resize')
            },

            eventKeydown(event)
            {
                pi.Arr.add(this.strokeCache, event.which);

                if ( ! pi.Arr.contains(this.strokeCache, [18, 79]) ) {
                    return;
                }

                this.modal = true;
            },

            eventKeyup(event)
            {
                pi.Arr.remove(this.strokeCache, event.which);
            },

            enableMode()
            {
                pi.Cookie.set('kyoto_sysmode', '1');

                window.location.reload();
            },

            disableMode()
            {
                pi.Cookie.set('kyoto_sysmode', '0');

                window.location.reload();
            }

        }

    }
</script>
