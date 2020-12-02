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
            <div class="kyo-website-node">{ this.value.title }</div>
        );
    }

}
