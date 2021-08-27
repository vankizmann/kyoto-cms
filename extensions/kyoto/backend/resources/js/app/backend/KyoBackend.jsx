import KyoNavigation from "./KyoNavigation";
import KyoWebpage from "./KyoWebpage";
import { Arr, Dom, Event, Cookie } from "@kizmann/pico-js";

export default {

    name: 'KyoBackend',

    components: {
        [KyoNavigation.name]: KyoNavigation,
        [KyoWebpage.name]: KyoWebpage,
    },

    computed: {

        logout()
        {
            return kyoto.paths.logout;
        },

        backendPaths()
        {
            return window.backendPaths;
        },

    },

    data()
    {
        return {
            locale: null, visSystem: false, visWebsite: true, strokeCache: []
        }
    },

    beforeMount()
    {
        this.locale = document.documentElement.lang;
    },

    mounted()
    {
        Event.bind('locale:change', this.onLocaleChange);
        Event.bind('stroke:change', this.onStrokeChange);

        Dom.find(window).on('keyup', this.onKeyup);
        Dom.find(window).on('keydown', this.onKeydown);
    },

    watch: {

        'locale': function () {
            Event.fire('locale:changed');
        }

    },

    methods: {

        onKeydown(event)
        {
            Arr.add(this.strokeCache, event.which);

            Event.fire('stroke:change', this.strokeCache);
        },

        onKeyup(event)
        {
            Arr.remove(this.strokeCache, event.which);

            Event.fire('stroke:change', this.strokeCache);
        },

        onLocaleChange(locale)
        {
            this.locale = locale;
        },

        onStrokeChange(stroke)
        {
            if ( Arr.contains(stroke, [18, 79]) ) {
                this.visSystem = true;
            }
        },

        setLocale(locale)
        {
            Event.fire('locale:change', locale);
        },

        enableSystem()
        {
            Cookie.set('kyoto_sysmode', '1');

            window.location.reload();
        },

        disableSystem()
        {
            Cookie.set('kyoto_sysmode', '0');

            window.location.reload();
        },

        showWebsite()
        {
            this.visWebsite = true;
        },

        hideWebsite()
        {
            this.visWebsite = false;
        }

    },

    renderNavi()
    {
        return (
            <KyoNavigation />
        );
    },

    renderPage()
    {
        let style = {};

        if ( ! this.visWebsite ) {
            style.display = 'none';
        }

        return (
            <KyoWebpage style={style} />
        );
    },

    renderBody()
    {
        return (
            <div class="kyo-body">
                <router-view />
            </div>
        );
    },

    renderSystem()
    {
        let confirmProps = {
            visible: this.visSystem,
            listen: false,
            confirmText: this.trans('Enable'),
            abortText: this.trans('Disable'),
        };

        confirmProps['onConfirm'] = () => {
            this.enableSystem();
        };

        confirmProps['onAbort'] = () => {
            this.disableSystem();
        };

        confirmProps['onUpdate:visible'] = (value) => {
            this.visSystem = value;
        };

        return (
            <NConfirm {...confirmProps}>
                { this.trans('Enable system mode?') }
            </NConfirm>
        )

    },

    render()
    {
        return (
            <div class="kyo-backend">
                { this.ctor('renderNavi')() }
                { this.ctor('renderPage')() }
                { this.ctor('renderBody')() }
                { this.ctor('renderSystem')() }
            </div>
        );
    }

}
