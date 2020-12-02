export default {

    name: 'KyoLayoutWebsite',

    data()
    {
        return {
            menus: []
        };
    },

    beforeMount()
    {
        Nano.Store.get('menus', (data) => this.menus = data, this._uid);
    },

    beforeDestroy()
    {
        Nano.store.off('menus', this._uid);
    },

    methods: {

        safeZone(height)
        {
            return height * 0.235;
        },

        renderNode(props)
        {
            return this.render('KyoWebsiteNode', { props });
        }

    },

    render(render)
    {
        this.render = render;

        let props = {
            renderExpand: true,
            safeZone: this.safeZone,
            renderNode: this.renderNode
        };

        return (
            <div class="kyo-layout-website">
                <NDraggable class="kyo-layout-website__body" items={this.menus} props={props} />
            </div>
        );

    }

}
