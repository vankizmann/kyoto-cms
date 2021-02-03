import { Obj, UUID } from "@kizmann/pico-js";
import { h, resolveComponent } from "vue";

export default {

    name: 'KyoPagebuilderBuilders',

    inject: {

        KyoPagebuilder: {
            default: undefined
        }

    },

    data()
    {
        return {};
    },

    methods: {

        safezone(height)
        {
            return height * 0.51;
        },

        transform(source)
        {
            return Obj.assign(source.node, { id: UUID() });
        },

        onUpdate(value)
        {
            this.KyoPagebuilder.$emit('update:modelValue', value);
        }

    },

    renderBuilderNode(props)
    {
        props.class = [
            'kyo-builder-item'
        ];

        if ( props.item.state === 0 ) {
            props.class.push('is-hidden');
        }

        let component = resolveComponent(props.item.type);

        if ( ! component ) {
            return null;
        }

        return h(component, props);
    },

    renderDraglist()
    {
        let props = {
            items: this.KyoPagebuilder.modelValue,
            group: ['page-widget'],
            allowGroups: ['page-widget'],
            handle: true,
            renderHandle: true,
            itemHeight: 0,
            keyEvents: false,
            threshold: 0,
            lazyload: false,
            renderCurrent: false,
            safezone: this.safezone,
            transformDrop: this.transform,
            renderNode: this.ctor('renderBuilderNode')
        };

        props['onUpdate:items'] = this.onUpdate;

        return (
            <NDraglist ref="draglist" {...props} />
        );
    },

    render()
    {
        return (
            <div class="kyo-pagebuilder-builders">
                { this.ctor('renderDraglist')() }
            </div>
        );
    }

}
