export default {

    name: 'KyoPageBuilder',

    props: {

        value: {
            default()
            {
                return [];
            }
        }

    },

    methods: {

        addRow()
        {
            this.$refs.list.pushItem({ id: Nano.UUID(), type: 'headline' });
        }

    },

    render(h)
    {
        let renderNode = ({ value }) => {
            return h(`KyoBlock${Nano.Str.ucfirst(value.type)}`, { props: { value } });
        }

        return (
            <div>
                <NDraggable ref="list" vModel={this.value.builder} useRenderCache={false} renderNode={renderNode}></NDraggable>
                <div>
                    <NButton vOn:click={this.addRow}>Add Row</NButton>
                </div>
            </div>
        );
    }

}
