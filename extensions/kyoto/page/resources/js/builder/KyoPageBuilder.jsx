export default {

    name: 'KyoPageWidgets',

    props: {

        value: {
            default()
            {
                return [];
            }
        }

    },

    data()
    {
        let widgets = [
            { id: Nano.UUID(), value: { title: '' }, type: 'headline', name: 'test1' },
            { id: Nano.UUID(), value: { title: '' }, type: 'headline', name: 'test2' }
        ]

        return {
            widgets
        }
    },

    methods: {

        transformDrop(source)
        {
            return Nano.Obj.assign(source, { id: Nano.UUID() });
        },

        allowDrop(source, target, strategy)
        {
            return ! this.value.length || strategy !== 'root';
        }

    },

    renderWidgetNode(props)
    {
        return (
            <div class="kyo-widgets-widget-item">
                { props.item.type }
            </div>
        );
    },

    renderBuilderNode(props)
    {
        return (
            <NForm class="kyo-widgets-builder-item">
                <div class="kyo-widgets-builder-item__head" draggable="true">
                    <div class="grid grid--row grid--middle grid--10">
                        <div class="col--auto col--left">
                            { props.item.type }
                        </div>
                        <div class="col--auto">
                            <NButton size="mini" type="info" square={true} icon={this.icons.create} vOn:click={props.copy}></NButton>
                        </div>
                        <div class="col--auto">
                            <NButton size="mini" type="danger" square={true} icon={this.icons.times} vOn:click={props.remove}></NButton>
                        </div>
                    </div>
                </div>
                <div class="kyo-widgets-builder-item__body">
                    { Vue.h(Vue.resolveComponent(`KyoWidget${Nano.Str.ucfirst(props.item.type)}`)) }
                </div>
            </NForm>
        );
    },

    render()
    {
        let builderProps = {
            items: this.value,
            group: ['page-widget'],
            allowGroups: ['page-widget'],
            handle: true,
            itemHeight: 0,
            viewportHeight: true,
            removeNode: false,
            insertNode: true,
            useRenderCache: false,
            keyEvents: false,
            threshold: 0,
            allowCurrent: false,
            transformDrop: this.transformDrop,
            allowDrop: this.allowDrop,
            renderNode: this.ctor('renderBuilderNode')
        }

        let widgetProps = {
            items: this.widgets,
            group: ['page-widget'],
            itemHeight: 0,
            viewportHeight: true,
            removeNode: false,
            insertNode: false,
            useRenderCache: false,
            keyEvents: false,
            threshold: 0,
            allowCurrent: false,
            allowDrop: false,
            renderNode: this.ctor('renderWidgetNode')
        }

        let builderEvents = {
            'input': (value) => this.$emit('input', value)
        }

        return (
            <div class="kyo-widgets">
                <div class="kyo-widgets__inner">
                    <NDraglist class="kyo-widgets__widget" ref="widget" {...widgetProps}>

                    </NDraglist>
                    <NDraglist class="kyo-widgets__builder" ref="builder" {...builderProps}>

                    </NDraglist>
                    <div class="kyo-widgets__extra">
                        { this.$slots.default && this.$slots.default() }
                    </div>
                </div>
            </div>
        );
    }

}
