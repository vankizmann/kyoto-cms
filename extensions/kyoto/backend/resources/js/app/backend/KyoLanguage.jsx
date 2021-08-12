import { Arr, Obj, Any, Event } from "@kizmann/pico-js";

export default {

    name: 'KyoLanguage',

    computed: {

        languages() {
            return kyoto.languages;
        }

    },

    methods: {

        changeLocale(locale)
        {
            Event.fire('locale:change', locale);
        },

    },

    renderOption(language)
    {
        let classList = [
            'kyo-language__item'
        ];


        if ( language.locale === this.$root.locale ) {
            classList.push('is-active');
        }

        let divProps = {
            href: 'javascript:void(0)',
        };

        divProps['onClick'] = () => {
            this.changeLocale(language.locale);
        };

        return (
            <a class={classList} {...divProps}>
                { language.language }<br />
            </a>
        );
    },

    renderPopover()
    {
        let popoverProps = {
            type: 'light',
            width: -1,
            trigger: 'click',
        };

        let options = Obj.each(this.languages, (language) => {
            return this.ctor('renderOption')(language);
        });

        return (
            <NPopover class="kyo-language__popover" {...popoverProps}>
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
            <div class="kyo-language__display">
                { labelHtml } { iconHtml }
            </div>
        );
    },

    render()
    {
        return (
            <div class="kyo-language">
                { this.ctor('renderDisplay')() }
                { this.ctor('renderPopover')() }
            </div>
        );
    }

}
