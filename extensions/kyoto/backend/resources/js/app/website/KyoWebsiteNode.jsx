export default {

    name: 'KyoWebsiteNode',

    props: {

        value: {
            required: true
        }

    },

    methods: {

        openEdit()
        {
            this.$router.push({ name: 'KyoMenuEdit', params: this.value });
        },

        openPreview()
        {
            window.open(this.value.preview);
        }

    },

    render()
    {
        return (
            <div class="kyo-website-node grid grid--row grid--middle" data-type={this.value.type}>
                <div class="col col--flex-1-1">
                    { this.value.title }
                </div>
                <div class="col col--flex-0-0">
                    <NButton type="info" plain={true} square={true} size="mini" icon="fa fa-pen" vOn:click={this.openEdit} />
                    <NButton type="primary" plain={true} square={true} size="mini" icon="fa fa-link" vOn:click={this.openPreview} />
                </div>
            </div>
        );
    }

}
