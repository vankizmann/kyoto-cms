import { countBy } from "lodash";

export default {

    name: 'KyoLayoutWebsite',

    data()
    {
        let query = {
            search: '', columns: ['title', 'slug']
        };

        return {
            query, result: [], search: '', load: true, modal: false
        };
    },

    mounted()
    {
        this.loadItems();

        this.$watch('search', Nano.Any.debounce(this.updateSearch, 800));

        Nano.Event.bind('website:refresh', this.loadItems, this._uid);
        Nano.Event.bind('locale:changed', this.loadItems, this._uid);
    },

    destroyed()
    {
        Nano.Event.unbind('locale:changed', this._uid);
    },

    watch: {

        'query.search': function () {
            this.loadItems();
        },

    },

    methods: {

        updateSearch()
        {
            this.query.search = this.search;
        },

        /**
         * Allow drag function for table
         * @returns {boolean}
         */
        allowDrag()
        {
            return false;
        },

        /**
         * Allow drop function for table
         * @returns {boolean}
         */
        allowDrop()
        {
            return false;
        },

        /**
         * Safezone for table
         * @returns {number}
         */
        safeZone(height)
        {
            return height * 0.235;
        },

        /**
         * Fetch items from server
         */
        loadItems()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get('/{locale}/kyoto/menu/http/controllers/menu/index',
                this.$root.$data, this.query);

            this.$http.get(route, options)
                .then(this.fetchDone, this.fetchError);
        },

        /**
         * Fetch items from server
         */
        moveItems(sources, target, strategy)
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let route = this.Route.get('/{locale}/kyoto/menu/http/controllers/menu/move',
                this.$root.$data);

            sources = Nano.Arr.each(sources, (source) => {
                return Nano.Obj.get(source, 'id');
            });

            let data = { source: sources, target, strategy };

            this.$http.post(route, data, options)
                .then(this.loadItems, this.fetchError);
        },

        transactItems(sources, target, strategy)
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let data = { source: sources, target, strategy };

            let route = this.Route.get('/{locale}/kyoto/menu/http/controllers/menu/transaction',
                this.$root.$data);

            this.$http.post(route, data, options)
                .then(this.loadItems, this.fetchError);
        },

        /**
         * Function when request succeeds
         * @param res
         */
        fetchDone(res)
        {
            this.result = res.data.data;
        },

        /**
         * Function when request fails
         * @param res
         */
        fetchError(res)
        {
            //
        },

        /**
         * Delete items on server
         */
        deleteItems()
        {
            let options = {
                onLoad: () => this.load = true,
                onDone: () => this.load = false
            };

            let query = {
                ids: this.selected
            };

            let route = this.Route.get('/{locale}/kyoto/menu/http/controllers/menu/delete',
                this.$root.$data);

            this.$http.post(route, query, options)
                .then(this.loadItems, this.fetchError);
        },

        /**
         * Goto edit form
         * @param row
         */
        gotoEdit(row)
        {
            if ( Nano.Obj.has(row, 'connector.edit') ) {
                this.$router.push(Nano.Obj.get(row, 'connector.edit'));
            }
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
            let items = Nano.Arr.map(sources, (source) => {
                return source.item;
            });

            target = Nano.Obj.get(target, 'item.id');

            if ( Nano.Arr.findIndex(items, { transaction: null }) !== -1 ) {
                return this.moveItems(sources, target, strategy);
            }

            return this.transactItems(sources, target, strategy);

            if ( sources.length !== 1 ) {
                return this.Notify(this.trans('Only one menu at time can be inserted.'), 'danger');
            }

            this.formBuffer = this.resetFormBuffer(Nano.Arr.first(items));

            this.modal = true;
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
            allowCurrent: true,
            // renderSelect: true,
            renderExpand: true,
            viewportHeight: true,
            ghostMode: true,
            threshold: 300,
            safeZone: this.safeZone,
            renderNode: this.renderNode
        };

        let events = {
            'move-code': (target, source, strategy) => {
                this.startTransaction(target, source, strategy);
            },
            'row-dblclick': (row) => {
                this.gotoEdit(this.Obj.get(row, 'item'));
            }
        };

        return (
            <NLoader visible={this.load} class="kyo-layout-website">
                <div class="kyo-layout-website__header">
                    <NInput vModel={this.search} placeholder={this.trans('Search for ...')}></NInput>
                </div>
                <NDraglist class="kyo-layout-website__body" items={this.result} props={props} on={events}>
                    { /*this.ctor('renderModal')()*/ }
                </NDraglist>
            </NLoader>
        );

    }

}
