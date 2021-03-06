export default {

    name: 'KyoWebsiteNode',

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

    computed: {

        // item()
        // {
        //     return this.NDraggableItem.item;
        // }

    },

    methods: {

        openEdit()
        {
            this.$router.push({ name: 'KyoMenuEdit', params: this.item });
        },

        openPreview()
        {
            window.open(this.item.preview);
        }

    },

    render()
    {
        return (
            <div class="kyo-website-node grid grid--row grid--middle" data-type={this.item.type}>
                <div class="col col--flex-1-1">
                    { this.item.title }
                </div>
                <div class="col col--flex-0-0">
                    <NButton type="info" square={true} size="xs" icon="fa fa-link" onClick={this.openPreview} />
                </div>
            </div>
        );
    }

}
