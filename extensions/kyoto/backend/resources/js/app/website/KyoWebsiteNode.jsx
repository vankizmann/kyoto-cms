export default {

    name: 'KyoWebsiteNode',

    props: {

        value: {
            required: true
        }

    },

    render()
    {
        return (
            <div class="kyo-website-node" data-type={this.value.type}>
                <span>
                    { this.value.title }
                </span>
            </div>
        );
    }

}
