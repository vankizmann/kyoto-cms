export default {

    name: 'KyoLayoutWebsite',

    data()
    {
        return {
            menus: [], load: true, modal: false
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
        },

        startTransaction(sources, target, strategy)
        {
            this.transaction = {
                sources, target, strategy
            };

            let items = Nano.Arr.map(sources, (source) => {
                return source.item;
            });

            if ( Nano.Arr.findIndex(items, { transaction: null }) !== -1 ) {
                return this.startMove();
            }

            this.modal = true;
        },

        startMove()
        {
            var { sources, target, strategy } = this.transaction;

            console.log('move', sources, target, strategy);

            Nano.Store.refresh('menus');
        },

        startInsert()
        {
            var { sources, target, strategy } = this.transaction;

            console.log('insert', sources, target, strategy);

            this.modal = false;

            Nano.Store.refresh('menus');
        },

    },

    renderModal()
    {
        return (
            <NModal selector={false} vModel={this.modal}>
                <template slot="header">
                    { this.trans('Attach item to menu') }
                </template>
                <NForm>
                    <NFormItem label={this.trans('Title')} prop="title">
                        <NInput placeholder="If empty title will be autofilled"></NInput>
                    </NFormItem>
                    <NFormItem label={this.trans('Slug')} prop="slug">
                        <NInput placeholder="If empty slug will be autofilled"></NInput>
                    </NFormItem>
                </NForm>
                <template slot="footer">
                    <NButton vOn:click={this.startInsert}>{ this.trans('Save') }</NButton>
                </template>
            </NModal>
        )
    },

    render(render)
    {
        this.render = render;

        let props = {
            itemHeight: 38,
            scrollTopOnChange: false,
            insertNode: false,
            removeNode: false,
            renderExpand: true,
            safeZone: this.safeZone,
            renderNode: this.renderNode
        };

        let events = {
            'move-code': (target, source, strategy) => {
                this.startTransaction(target, source, strategy);
            },
            'row-dblclick': (row) => {
                this.$router.push({ key: row.id, name: 'KyoMenuEdit', params: row.item });
            }
        };

        return (
            <NLoader visible={this.load} class="kyo-layout-website">
                <div class="kyo-layout-website__header">
                    <NInput placeholder={this.trans('Search for ...')}></NInput>
                </div>
                <NDraggable class="kyo-layout-website__body" items={this.menus} props={props} on={events} />
                <div class="kyo-layout-website__footer">
                    <NButton type="secondary" link={true}>{ this.trans('Add menu') }</NButton>
                </div>
                { this.ctor('renderModal')() }
            </NLoader>
        );

    }

}
