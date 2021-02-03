import { Arr, Any, Dom } from "@kizmann/pico-js";
import KyoWidget from "../prototypes/KyoWidget";

export default {

    name: 'KyoWidgetHeadline',

    extends: KyoWidget,

    data()
    {
        return { height: 0 };
    },

    mounted()
    {
        this.getHeight();
    },

    watch: {

        'data.tag': function () {
            this.$nextTick(this.getHeight);
        },

        'data.title': function () {
            this.$nextTick(this.getHeight);
        }

    },

    methods: {

        onResize()
        {
            this.getHeight();
        },

        onInput(event)
        {
            this.data.title = event.target.value;
        },

        getHeight()
        {
            this.height = Dom.find(this.$refs.textarea)
                .actual(el => el.scrollHeight);
        }

    },

    renderTag(value)
    {
        let classList = [
            'kyo-widget-headline__tag'
        ];

        if ( value === this.data.tag ) {
            classList.push('is-active');
        }

        let setTag = () => {
            this.data.tag = value;

            this.$nextTick(this.getHeight);
        }

        return (
            <span class={classList} onClick={setTag}>{ value }</span>
        );
    },

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

        return (
            <div class="kyo-widget-headline__tags">
                { Arr.each(tags, this.ctor('renderTag'))}
            </div>
        )
    },

    render()
    {
        let classList = [
            'kyo-widget-headline',
            'kyo-widget-headline--' + this.data.tag
        ];

        let props = {
            value: this.data.title,
            placeholder: this.trans('Enter your headline'),
            onInput: this.onInput
        };

        let style = {};

        if ( this.height ) {
            style.height = this.height + 'px';
        }

        return (
            <div class={classList}>
                { this.ctor('renderHeader')() }
                <div class="grid grid--row grid--5" style="margin-top: -10px; margin-bottom: 20px;">
                    <div class="col--flex-0-0">
                        <NButton size="sm" type="wysiwyg" icon="fa fa-bold">
                            Bold
                        </NButton>
                    </div>
                    <div class="col--flex-0-0">
                        <NButton size="sm" type="wysiwyg" icon="fa fa-italic">
                            Italic
                        </NButton>
                    </div>
                    <div class="col--flex-0-0">
                        <NButton size="sm" type="wysiwyg" icon="fa fa-underline">
                            Underline
                        </NButton>
                    </div>
                </div>
                <textarea ref="textarea" rows="1" style={style} {...props} />
            </div>
        )
    }

}
