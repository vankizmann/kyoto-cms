import { Arr, Any, Dom } from "@kizmann/pico-js";
import KyoWidget from "../prototypes/KyoWidget";

export default {

    name: 'KyoWidgetWysiwyg',

    extends: KyoWidget,

    data()
    {
        return { height: 0 };
    },

    mounted()
    {
        this.getHeight();
    },

    methods: {

        onResize()
        {
            this.getHeight();
        },

        onInput(event)
        {
            this.data.title = event.target.value;

            this.getHeight();
        },

        getHeight()
        {
            this.height = Dom.find(this.$refs.textarea)
                .actual(el => el.scrollHeight);
        }

    },

    render()
    {
        let classList = [
            'kyo-widget-wysiwyg',
        ];

        let props = {
            value: this.data.title,
            placeholder: this.trans('Enter your text'),
            onInput: this.onInput
        };

        let style = {};

        if ( this.height ) {
            style.height = this.height + 'px';
        }

        return (
            <div class={classList}>
                <KyoWidgetTitlebar></KyoWidgetTitlebar>
                <textarea ref="textarea" rows="2" style={style} {...props} />
            </div>
        )
    }

}
