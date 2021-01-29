export default {

    name: 'KyoWebsite',

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

        pi.Event.bind('website:refresh', this.loadItems, this._.uid);
        pi.Event.bind('locale:changed', this.loadItems, this._.uid);
    },

    beforeUnmount()
    {
        pi.Event.unbind('locale:changed', this._.uid);
    },

    methods: {

        updateSearch(event)
        {
            if ( event.which !== 13 ) {
                return;
            }

            this.query.search = event.target.value;

            this.loadItems();
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
        safezone(height)
        {
            return height * 0.235;
        },

        /**
         * Fetch items from server
         */
        loadItems()
        {
            console.log('load');
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

            sources = pi.Arr.each(sources, (source) => {
                return pi.Obj.get(source, 'id');
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
            if ( pi.Obj.has(row, 'connector.edit') ) {
                this.$router.push(pi.Obj.get(row, 'connector.edit'));
            }
        },

        renderNode(props)
        {
            return this.render('KyoWebsiteNode', { props });
        },

        resetFormBuffer(item = {})
        {
            return {
                title: pi.Obj.get(item, 'title', ''), slug: pi.Obj.get(item, 'slug', '')
            };
        },

        startTransaction(sources, target, strategy)
        {
            let items = pi.Arr.map(sources, (source) => {
                return source.item;
            });

            target = pi.Obj.get(target, 'item.id');

            if ( pi.Arr.findIndex(items, { transaction: null }) !== -1 ) {
                return this.moveItems(sources, target, strategy);
            }

            return this.transactItems(sources, target, strategy);
        },

    },

    renderSearch()
    {
        let props = {
            placeholder: this.trans('Search for ...'),
            onKeydown: this.updateSearch
        };

        return (
            <div class="kyo-layout-website__search">
                <input type="text" {...props} />
            </div>
        )
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
            disableMove: true,
            allowCurrent: true,
            // renderSelect: true,
            renderExpand: true,
            safezone: this.safezone,
        };

        props['onMoveraw'] = (target, source, strategy) => {
            this.startTransaction(target, source, strategy);
        };

        props['onRowDblclick'] = (row) => {
            this.gotoEdit(this.Obj.get(row, 'item'));
        };

        return (
            <NLoader visible={this.load} class="kyo-layout-website">
                <div class="kyo-layout-website__header">
                    { this.ctor('renderSearch')() }
                </div>
                <NDraglist class="kyo-layout-website__body" items={this.result} {...props}>
                    {
                        {
                            default: (props) => <KyoWebsiteNode {...props} />
                        }
                    }
                </NDraglist>
            </NLoader>
        );

    }

}
