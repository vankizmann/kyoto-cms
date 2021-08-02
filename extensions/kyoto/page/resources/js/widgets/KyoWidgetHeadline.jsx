import { Arr, Any, Dom } from "@kizmann/pico-js";
import KyoWidget from "../prototypes/KyoWidget";

export default {

    name: 'KyoWidgetHeadline',

    extends: KyoWidget,

    renderHeader()
    {
        let options = {
            'h1': 'h1',
            'h2': 'h2',
            'h3': 'h3',
            'h4': 'h4',
            'h5': 'h5',
            'h6': 'h6',
        };

        return (
            <KyoWidgetTitlebar>
                <NSelect vModel={this.data.tag} options={options} />
            </KyoWidgetTitlebar>
        );
    },

    render()
    {
        let classList = [
            'kyo-widget-headline',
            'kyo-widget-headline--' + this.data.tag
        ];

        let props = {
            renderList: ['b', 'i', 'u', ['atl', 'atc', 'atr']],
            placeholder: this.trans('Enter your headline'),
        };

        let style = {};

        if ( this.height ) {
            style.height = this.height + 'px';
        }

        return (
            <div class={classList}>
                { this.ctor('renderHeader')() }
                <KyoWysiwyg vModel={this.data.title} {...props} />
            </div>
        )
    }

}
