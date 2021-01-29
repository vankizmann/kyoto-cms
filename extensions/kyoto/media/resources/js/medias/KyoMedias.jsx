
export default {

    name: 'KyoMedias',

    extends: window.KyoIndex,

    localized: true,

    urls: {
        index: '/{locale}/kyoto/media/http/controllers/media/index',
        move: '/{locale}/kyoto/media/http/controllers/media/move',
        delete: '/{locale}/kyoto/media/http/controllers/media/delete'
    },

    props: {

        navigation: {
            default()
            {
                return true;
            },
            type: [Boolean]
        },

        size: {
            default()
            {
                return 'default';
            },
            type: [String]
        },

        root: {
            default()
            {
                return '00000000-0000-0000-0000-000000000000';
            },
            type: [String]
        }

    },

    defaults() {

        let query = {
            parent: '', page: 1, limit: 100, prop: 'title', dir: 'asc', filter: [], search: '', columns: ['title', 'type']
        };

        return { query };
    },

    data()
    {
        return { parent: null }
    },

    beforeMount()
    {
        this.getParent();
    },

    mounted()
    {
        this.$watch('query.parent', this.loadItems);
        pi.Event.bind('media:refresh', this.loadItems);
    },

    watch: {

        '$route': function () {
            this.getParent();
        },

        'result.breadcrumbs': function () {
            this.setParent();
        }

    },

    methods: {

        setParent()
        {
            this.parent = pi.Arr.last(this.result.breadcrumbs);
        },

        getParent()
        {
            this.query.parent = window.location.hash.replace(/^#/, '');
        },

        gotoHome()
        {
            if ( ! this.navigation ) {
                return this.query.parent = this.root;
            }

            this.$router.push({ name: 'KyoMedias' });
        },

        gotoParent()
        {
            if ( pi.Obj.get(this.parent, 'above.id') === this.root ) {
                return this.gotoHome();
            }

            if ( ! this.navigation ) {
                return this.query.parent = this.parent.above.id;
            }

            this.$router.push({
                name: 'KyoMedias', hash: `#${this.parent.above.id}`
            });
        },

        gotoFolder(row)
        {
            if ( pi.Obj.get(row, 'item.id') === this.root ) {
                return this.gotoHome();
            }

            if ( ! this.navigation ) {
                return this.query.parent = pi.Obj.get(row, 'item.id');
            }

            this.$router.push({
                name: 'KyoMedias', hash: `#${row.item.id}`
            });
        },

        gotoFile(row)
        {
            if ( ! this.navigation ) {
                return;
            }

            this.$router.push({
                name: this.__self(null, 'Edit'), params: row.item
            });
        },

        gotoCreate()
        {
            let options = {
                name: this.__self(null, 'Create')
            };

            if ( this.parent ) {
                options.hash = `#${this.parent.id}`;
            }

            this.$router.push(options);
        },

        gotoEdit(row)
        {
            pi.Arr.has(['system/folder', 'system/above'], row.item.type) ?
                this.gotoFolder(row) : this.gotoFile(row);
        },


        allowSelect(source)
        {
            return source.veItem.type !== 'system/above';
        },

        allowDrag(source)
        {
            return source.veItem.type !== 'system/above';
        },

        allowDrop(source, target)
        {
            if ( ! this.navigation ) {
                return false;
            }

            if ( source.item.type === 'system/above' ) {
                return false;
            }

            return pi.Arr.has(['system/folder', 'system/above'],
                pi.Obj.get(target, 'item.type'));
        }

    },

    renderNodeTitle(value)
    {
        if ( ! this.navigation ) {
            return (<span>{ value.title }</span>);
        }

        let clickEvent = () => {
            this.gotoFile({ item: value });
        };

        return (
            <a href="javascript:void(0)" vOn:click={clickEvent}>
                { value.title }
            </a>
        );
    },

    renderViewNode(value)
    {
        return (
            <div class="kyo-media-grid-item">
                <div class="kyo-media-grid-item__image">
                    <img src={ value.urls['square/sm'] } />
                </div>
                <div class="kyo-media-grid-item__title">
                    { this.ctor('renderNodeTitle')(value) }
                </div>
                <div class="kyo-media-grid-item__meta">
                    <span>{ value.type }</span>
                </div>
            </div>
        );
    },

    renderIconNode(value)
    {
        return (
            <div class="kyo-media-grid-item">
                <div class="kyo-media-grid-item__icon" data-type={value.type}>
                    <span>{ value.file.replace(/^(.*?)\./, '') }</span>
                </div>
                <div class="kyo-media-grid-item__title">
                    { this.ctor('renderNodeTitle')(value) }
                </div>
                <div class="kyo-media-grid-item__meta">
                    <span>{ value.type }</span>
                </div>
            </div>
        );
    },

    renderFolderNode(value)
    {
        return (
            <div class="kyo-media-grid-item">
                <div class="kyo-media-grid-item__icon" data-type={value.type}>
                    <span>{ value.count }</span>
                </div>
                <div class="kyo-media-grid-item__title">
                    { this.ctor('renderNodeTitle')(value) }
                </div>
                <div class="kyo-media-grid-item__meta">
                    <span>{ value.type }</span>
                </div>
            </div>
        );
    },

    renderAboveNode(value)
    {
        return (
            <div class="kyo-media-grid-item">
                <div class="kyo-media-grid-item__icon" data-type={value.type}>
                    { /* No additional info */}
                </div>
                <div class="kyo-media-grid-item__title">
                    <span>{ value.title }</span>
                </div>
                <div class="kyo-media-grid-item__meta">
                    <span>{ value.type }</span>
                </div>
            </div>
        );
    },

    renderNode({ value })
    {
        if ( value.type === 'system/above' ) {
            return this.ctor('renderAboveNode')(value);
        }

        if ( value.type === 'system/folder' ) {
            return this.ctor('renderFolderNode')(value);
        }

        if ( ! pi.Any.isEmpty(value.view) ) {
            return this.ctor('renderViewNode')(value);
        }

        return this.ctor('renderIconNode')(value);
    },

    renderToolbar()
    {
        if ( ! this.navigation ) {
            return null;
        }

        return (
            <KyoTitlebar class="col--flex-0-0" vOn:delete={this.deleteItems}>

                <template v-slot:search>
                    <KyoTitlebarSearch vModel={this.query.search} />
                </template>

            </KyoTitlebar>
        );
    },

    renderFilterbar()
    {
        let rootButton = (
            <div class="col--auto">
                <NButton size={this.size} icon="fa fa-home" disabled={!this.query.parent} vOn:click={this.gotoHome}>
                    { this.trans('Root') }
                </NButton>
            </div>
        )

        let aboveButton = (
            <div class="col--auto">
                <NButton size={this.size} icon="fa fa-arrow-up" disabled={!this.query.parent} vOn:click={this.gotoParent}>
                    { this.trans('Above') }
                </NButton>
            </div>
        );

        let createFolder = (
            <div class="col--auto">
                <NButton size={this.size} type="success" icon="fa fa-folder" vOn:click={this.gotoCreate}>
                    { this.trans('Folder') }
                </NButton>
            </div>
        );

        let createVideo = (
            <div class="col--auto">
                <KyoVideos size={this.size}></KyoVideos>
            </div>
        );

        let createFile = (
            <div class="col--auto">
                <KyoUploads size={this.size}></KyoUploads>
            </div>
        );

        let spacerDiv = (
            <div class="col--flex-1-1">
                { /* Spacer */ }
            </div>
        )

        let sortOptions = {
            title: this.trans('Title'),
            type: this.trans('Type'),
            updated_at: this.trans('Modified'),
            created_at: this.trans('Created'),
        };

        let sortSelect = (
            <div class="col--auto">
                <NSelect size={this.size} vModel={this.query.prop} style="width: 140px;" options={sortOptions}>
                    { /* Sortfields */ }
                </NSelect>
            </div>
        );

        let orderOptions = {
            asc: this.trans('Ascending'),
            desc: this.trans('Descending')
        };

        let orderSelect = (
            <div class="col--auto">
                <NSelect size={this.size} vModel={this.query.dir} style="width: 140px;" options={orderOptions}>
                    { /* Orderfields */ }
                </NSelect>
            </div>
        );

        let renderItems = [
            rootButton, aboveButton
        ];

        if ( this.navigation ) {
            renderItems.push(createFolder, createVideo, createFile);
        }

        renderItems.push(spacerDiv, sortSelect, orderSelect);

        return (
            <KyoFilterbar class="col--flex-0-0">
                <div class="grid grid--row grid--10">
                    { renderItems }
                </div>
            </KyoFilterbar>
        );
    },

    renderDatagrid()
    {
        let draggridProps = {
            current: this.current,
            selected: this.selected,
            items: this.result.data,
            itemHeight: 215,
            renderSelect: true,
            insertNode: false,
            removeNode: false,
            moveItems: false,
            allowSelect: this.allowSelect,
            allowDrag: this.allowDrag,
            allowDrop: this.allowDrop,
            renderNode: this.ctor('renderNode')
        }

        let draggridEvents = {
            'update:current': (value) => this.current = value,
            'update:selected': (value) => this.selected = value,
            'move': this.onMove,
            'row-dblclick': this.gotoEdit
        }

        let paginatorProps = {
            page: this.query.page,
            limit: this.query.limit,
            total: this.result.total,
            layout: ['limit', 'count', 'spacer', 'goto', 'pages']
        }

        let paginatorEvents = {
            'update:page': (value) => this.query.page = value,
            'update:limit': (value) => this.query.limit = value
        }

        return (
            <div class="kyo-datagrid col--flex-1-0">
                <NDraggrid props={draggridProps} on={draggridEvents}>
                    { /* Filegrid */ }
                </NDraggrid>
                <NPaginator props={paginatorProps} on={paginatorEvents}>
                    { /* Pagination */ }
                </NPaginator>
            </div>
        );
    },

    render()
    {
        return (
            <NLoader visible={this.load} class="full-height-child">
                <div class="grid grid--col">
                    { this.ctor('renderToolbar')() }
                    { this.ctor('renderFilterbar')() }
                    { this.ctor('renderDatagrid')() }
                </div>
            </NLoader>
        );
    }
}
