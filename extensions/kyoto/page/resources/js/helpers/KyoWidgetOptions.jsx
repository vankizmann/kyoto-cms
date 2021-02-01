import { Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoWidgetTitlebar',

    props: {

        item: {
            required: true
        },

        width: {
            default()
            {
                return 300;
            },
            type: [Number]
        }

    },

    inject: {

        NDraggableItem: {
            default: undefined
        },

        KyoPageBuilder: {
            default: undefined
        },

        KyoWidget: {
            default: undefined
        }

    },

    computed: {

        widget()
        {
            return Obj.get(this.KyoPageBuilder.widgets,
                this.KyoWidget.item.type);
        },

        title()
        {
            return Obj.get(this.widget, 'title');
        }

    },

    renderPopover()
    {
        let props = {
            position: 'bottom-start',
            width: this.width
        };

        let switchProps = {
            onValue: 0,
            ofValue: 1,
            onType: 'danger',
        };

        return (
            <NPopover trigger="click" {...props}>
                { this.$slots.default && this.$slots.default() }
                <NSwitch vModel={this.KyoWidget.item.state} {...switchProps}>
                    { this.trans('Disabled') }
                </NSwitch>
            </NPopover>
        );
    },

    renderTitle()
    {
        let props = {
            size: 'sm',
            link: true,
            type: 'default',
        };

        return (
            <div class="kyo-widget-options__title">
                <NButton {...props}>{ this.title }</NButton>
            </div>
        );
    },

    renderCopy()
    {
        let props = {
            size: 'sm',
            link: true,
            type: 'info'
        };

        return (
            <div class="kyo-widget-options__copy">
                <NButton {...props} onClick={this.KyoWidget.copy}>
                    { this.trans('Copy') }
                </NButton>
            </div>
        );
    },

    renderRemove()
    {
        let props = {
            size: 'sm',
            link: true,
            type: 'danger'
        };

        return (
            <div class="kyo-widget-options__remove">
                <NButton {...props} onClick={this.KyoWidget.remove}>
                    { this.trans('Remove') }
                </NButton>
            </div>
        );
    },

    render()
    {
        return (
            <div class="kyo-widget-options">
                { this.ctor('renderTitle')() }
                { this.ctor('renderPopover')() }
                { this.ctor('renderCopy')() }
                { this.ctor('renderRemove')() }
            </div>
        );
    }

}
