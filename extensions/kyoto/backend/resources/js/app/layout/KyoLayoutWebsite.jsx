import { countBy } from "lodash";

export default {

    name: 'KyoLayoutWebsite',

    data()
    {
        return {
            menus: [], load: true, modal: false, formBuffer: this.resetFormBuffer()
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

        openEdit(row)
        {
            if ( Nano.Obj.has(row, 'connector.edit') ) {
                this.$router.push(Nano.Obj.get(row, 'connector.edit'))
            }
        },

        safeZone(height)
        {
            return height * 0.235;
        },

        renderNode(props)
        {
            return this.render('KyoWebsiteNode', { props });
        },

        resetFormBuffer(item = {})
        {
            return {
                title: Nano.Obj.get(item, 'title', ''), slug: Nano.Obj.get(item, 'slug', '')
            };
        },

        startTransaction(sources, target, strategy)
        {
            if ( sources.length !== 1 ) {
                return this.Notify(this.trans('Only one menu at time can be inserted.'), 'danger');
            }

            this.transaction = {
                sources, target, strategy
            };

            let items = Nano.Arr.map(sources, (source) => {
                return source.item;
            });

            if ( Nano.Arr.findIndex(items, { transaction: null }) !== -1 ) {
                return this.startMove();
            }

            this.formBuffer = this.resetFormBuffer(Nano.Arr.first(items));

            this.modal = true;
        },

        startMove()
        {
            var { sources, target, strategy } = this.transaction;

            target = Nano.Obj.get(target, 'item.id');

            sources = Nano.Arr.each(sources, (source) => {
                return Nano.Obj.get(source, 'id');
            });

            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {
                source: sources, target, strategy
            };

            let route = this.Route.get('/{locale}/kyoto/menu/http/controllers/menu/move',
                this.$root.$data);

            this.$http.post(route, query, options)
                .then(() => Nano.Store.refresh('menus'), () => null);
        },

        startInsert()
        {
            var { sources, target, strategy } = this.transaction;

            target = Nano.Obj.get(target, 'item.id');

            this.modal = false;

            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {
                source: sources, target, strategy
            };

            let route = this.Route.get('/{locale}/kyoto/menu/http/controllers/menu/transaction',
                this.$root.$data);

            this.$http.post(route, query, options)
                .then(() => Nano.Store.refresh('menus'), () => null);
        },

    },

    renderModal()
    {
        return (
            <NModal selector={false} vModel={this.modal}>
                <template slot="header">
                    { this.trans('Attach item to menu') }
                </template>
                <NForm form={this.formBuffer}>
                    <NFormItem label={this.trans('Title')} prop="title">
                        <NInput vModel={this.formBuffer.title} placeholder="If empty title will be autofilled"></NInput>
                    </NFormItem>
                    <NFormItem label={this.trans('Slug')} prop="slug">
                        <NInput vModel={this.formBuffer.slug} placeholder="If empty slug will be autofilled"></NInput>
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
            group: ['menu'],
            allowGroups: ['menu', 'transaction'],
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
                this.openEdit(this.Obj.get(row, 'item'));
            }
        };

        return (
            <NLoader visible={this.load} class="kyo-layout-website">
                <div class="kyo-layout-website__header">
                    <NInput placeholder={this.trans('Search for ...')}></NInput>
                    <div class="grid grid--row">
                        <NButton class="col--1-1" icon="fa fa-plus">{this.trans('Add menu')}</NButton>
                    </div>
                </div>
                <NDraglist class="kyo-layout-website__body" items={this.menus} props={props} on={events} />
                { this.ctor('renderModal')() }
            </NLoader>
        );

    }

}
