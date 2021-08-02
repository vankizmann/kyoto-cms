import { Any, Arr } from "@kizmann/pico-js";

export default {

    name: 'KyoPagebuilderWidgets',

    inject: {

        KyoPagebuilder: {
            default: undefined
        }

    },

    data()
    {
        return {
            search: ''
        };
    },

    methods: {

        onInput(event)
        {
            this.search = event.target.value;
        }

    },

    renderWidgetNode(props)
    {
        return (
            <div class="kyo-pagebuilder-widgets__item">
                <h4>{ props.item.title }</h4><p>{ props.item.description }</p>
            </div>
        );
    },

    renderIcon()
    {
        let icon = nano.Icons.search;

        if ( this.search ) {
            icon = nano.Icons.times;
        }

        let resetSearch = () => {
            this.search = '';
        }

        return (
            <div class="kyo-pagebuilder-widgets__icon" onClick={resetSearch}>
                <i class={icon}></i>
            </div>
        );
    },

    renderInput()
    {
        let props = {
            value: this.search,
            placeholder: this.trans('Search widget'),
            onInput: this.onInput
        }
        return (
            <div class="kyo-pagebuilder-widgets__input">
                <input type="text" {...props} />
            </div>
        );
    },

    renderHeader()
    {
        return (
            <div class="kyo-pagebuilder-widgets__header">
                { this.ctor('renderIcon')() }
                { this.ctor('renderInput')() }
            </div>
        );
    },

    renderDraglist()
    {
        let widgets = Any.vals(this.KyoPagebuilder.widgets);

        if ( this.search ) {
            widgets = Arr.filter(widgets, (widget) => {
                return widget.title.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
            });
        }

        let props = {
            items: widgets,
            group: ['page-widget'],
            useKeys: true,
            itemHeight: 0,
            removeNode: false,
            keyEvents: false,
            threshold: 0,
            lazyload: false,
            allowCurrent: false,
            allowDrop: false,
            renderNode: this.ctor('renderWidgetNode')
        };

        return (
            <NDraglist ref="draglist" {...props} />
        );
    },

    render()
    {
        return (
            <div class="kyo-pagebuilder-widgets">
                { this.ctor('renderHeader')() }
                { this.ctor('renderDraglist')() }
            </div>
        );
    }

}
