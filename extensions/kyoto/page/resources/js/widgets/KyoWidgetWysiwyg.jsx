import { Arr, Any, Dom } from "@kizmann/pico-js";
import KyoWidget from "../prototypes/KyoWidget";

export default {

    name: 'KyoWidgetWysiwyg',

    extends: KyoWidget,

    methods: {

        onInput(value)
        {
            this.data.title = value;
        },

    },

    render()
    {
        let classList = [
            'kyo-widget-wysiwyg',
        ];

        let props = {
            placeholder: this.trans('Enter your text'),
        };

        return (
            <div class={classList}>
                <KyoWidgetTitlebar />
                <KyoWysiwyg vModel={this.data.title} {...props} />
            </div>
        )
    }

}
