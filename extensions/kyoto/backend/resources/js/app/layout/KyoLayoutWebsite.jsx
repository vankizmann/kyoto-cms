export default {

    name: 'KyoLayoutWebsite',

    data()
    {
        return {
            menus: [], load: true
        };
    },

    beforeMount()
    {
        Nano.Event.bind('store/fetch:menus', () => {
            this.load = true;
        }, this._uid);

        Nano.Event.bind('store/fetched:menus', () => {
            this.load = false;
        }, this._uid);

        Nano.Store.get('menus', (data) => this.menus = data, this._uid);
    },

    beforeDestroy()
    {
        Nano.Event.unbind('store/fetch:menus', this._uid);
        Nano.Event.unbind('store/fetched:menus', this._uid);

        Nano.Store.forget('menus', this._uid);
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

        let events = {
            'row-dblclick': (row) => {
                this.$router.push({ key: row.id, name: 'KyoMenuEdit', params: row.item });
            }
        };

        return (
            <NLoader visible={this.load} class="kyo-layout-website">
                <NDraggable class="kyo-layout-website__body" items={this.menus} props={props} on={events} />
            </NLoader>
        );

    }

}
