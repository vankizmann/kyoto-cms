import { Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoWebpageNode',

    props: {

        value: {
            required: true
        },

        item: {
            required: true
        }

    },

    inject: {

        NDraggableItem: {
            default: undefined,
        }

    },

    methods: {

        openEdit()
        {
            let name = Obj.get(this.item,
                'connector.edit.name', 'KyoMenuEdit');

            let params = Obj.get(this.item,
                'connector.edit.params', this.item);

            this.$router.push({ name, params });
        },

        openPreview()
        {
            window.open(this.item.preview);
        }

    },

    render()
    {
        let divProps = {
            'data-type': this.item.type
        };

        divProps['onDblclick'] = () => {
            this.openEdit();
        };

        let previewProps = {
            type: 'info',
            icon: 'fa fa-link',
            size: 'xs',
            square: true,
        };

        previewProps['onClick'] = () => {
            this.openPreview();
        };

        return (
            <div class="kyo-webpage-node" {...divProps}>
                <div class="kyo-webpage-node__title">
                    { this.item.title }
                </div>
                <div class="kyo-webpage-node__tools">
                    <NButton {...previewProps} />
                </div>
            </div>
        );
    }

}
