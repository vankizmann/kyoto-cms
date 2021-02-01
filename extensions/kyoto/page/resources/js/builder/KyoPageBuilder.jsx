import { resolveComponent, h } from "vue";
import { Arr, Obj, Any } from "@kizmann/pico-js";

export default {

    name: 'KyoPageWidgets',

    props: {

        modelValue: {
            default()
            {
                return [];
            }
        }

    },

    provide()
    {
        return {
            KyoPageBuilder: this
        }
    },

    data()
    {
        return {
            load: false, widgets: []
        };
    },

    mounted()
    {
        this.fetchWidgets();
    },

    methods: {

        fetchWidgets()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get('/{locale}/kyoto/page/http/controllers/widget/list',
                this.$root.$data);

            this.$http.get(route, options)
                .then(this.fetchDone, this.fetchError);
        },

        fetchDone(res)
        {
            this.widgets = res.data;
        },

        fetchError(res)
        {

        },

        transformDrop(source)
        {
            return pi.Obj.assign(source.node, { id: pi.UUID() });
        },

        allowDrop(source, target, strategy)
        {
            return ! this.modelValue.length || strategy !== 'root';
        }

    },

    renderWidgetNode(props)
    {
        return (
            <div class="kyo-widget-item">
                <h4>{ props.item.title }</h4>
                <p>{ props.item.description }</p>
            </div>
        );
    },

    renderBuilderNode(props)
    {
        props.class = [
            'kyo-builder-item'
        ];

        if ( props.item.state === 0 ) {
            props.class.push('is-hidden');
        }

        return h(resolveComponent(props.item.type), props);
    },

    render()
    {
        let builderProps = {
            items: this.modelValue,
            group: ['page-widget'],
            allowGroups: ['page-widget'],
            handle: true,
            renderHandle: true,
            itemHeight: 0,
            removeNode: true,
            insertNode: true,
            keyEvents: false,
            threshold: 0,
            lazyload: false,
            renderCurrent: false,
            // renderHandle: true,
            safezone: (height) => height * 0.51,
            transformDrop: this.transformDrop,
            // allowDrop: this.allowDrop,
            renderNode: this.ctor('renderBuilderNode'),
            'onUpdate:items': (value) => this.$emit('update:modelValue', value)
        }

        let widgetProps = {
            items: pi.Any.vals(this.widgets),
            group: ['page-widget'],
            itemHeight: 0,
            removeNode: false,
            insertNode: false,
            keyEvents: false,
            threshold: 0,
            lazyload: false,
            allowCurrent: false,
            allowDrop: false,
            renderNode: this.ctor('renderWidgetNode')
        }

        return (
            <div class="kyo-widgets">
                <div class="kyo-widgets__inner">
                    <NDraglist class="kyo-widgets__widget" ref="widget" {...widgetProps} />
                    <NDraglist class="kyo-widgets__builder" ref="builder" {...builderProps} />
                    <NScrollbar class="kyo-widgets__extra">
                        <div class="kyo-widgets__wrap">
                            { this.$slots.default && this.$slots.default() }
                        </div>
                    </NScrollbar>
                </div>
            </div>
        );
    }

}
