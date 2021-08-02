import { Arr, Obj, Any, Locale, Event } from "@kizmann/pico-js";

export default {

    name: 'KyoLayoutLanguage',

    computed: {

        languages() {
            return kyoto.languages;
        }

    },

    mounted()
    {
        this.addDashes();
    },

    methods: {

        changeLocale(locale)
        {
            Event.fire('locale:change', locale);
        },

        addDashes()
        {
            Arr.each(this.languages, (lang) => {
                kyoto.addDash({
                    type: 'locale',
                    title: lang.language,
                    description: Locale.trans('Change current language to :language', lang),
                    callback: () => this.changeLocale(lang.locale)
                });
            });
        }

    },

    renderOption(language)
    {
        let props = {
            onClick: () => this.changeLocale(language.locale)
        }

        if ( language.locale === this.$root.locale ) {
            props.active = true;
        }

        if ( language.locale === this.$root.locale ) {
            props.icon = nano.Icons.checked;
        }

        return (
            <NPopoverOption {...props}>
                { language.language }<br /><i>{ language.country }</i>
            </NPopoverOption>
        );
    },

    renderPopover()
    {
        let options = Obj.each(this.languages, (language) => {
            return this.ctor('renderOption')(language);
        });

        return (
            <NPopover class="n-popover--locale" width={-1} trigger="click" position="bottom-end">
                { Any.vals(options) }
            </NPopover>
        );
    },

    renderDisplay()
    {
        let language = Arr.find(this.languages, {
            locale: this.$root.locale
        });


        let iconHtml = (
            <i class={['n-icon', nano.Icons.angleDown]} />
        );

        let labelHtml = (
            <span>{ language.language }<br /><i>{ language.country }</i></span>
        );

        return (
            <div class="kyo-layout-language__display">
                { labelHtml } { iconHtml }
            </div>
        );
    },

    render()
    {
        return (
            <div class="kyo-layout-language">
                { this.ctor('renderDisplay')() }
                { this.ctor('renderPopover')() }
            </div>
        );
    }

}
