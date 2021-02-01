
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
        pi.Event.bind('media:refresh', this.loadItems);
    },

    watch: {

        '$route': function () {
            this.getParent();
        },

        'query.parent': function () {
            this.loadItems();
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
            this.query.parent = window.location.hash
                .replace(/^#/, '') || this.root;
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
            return source.item.type !== 'system/above';
        },

        allowDrag(source)
        {
            return source.item.type !== 'system/above';
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
            <a href="javascript:void(0)" onClick={clickEvent}>
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

    renderNode({ item })
    {
        if ( item.type === 'system/above' ) {
            return this.ctor('renderAboveNode')(item);
        }

        if ( item.type === 'system/folder' ) {
            return this.ctor('renderFolderNode')(item);
        }

        if ( ! pi.Any.isEmpty(item.view) ) {
            return this.ctor('renderViewNode')(item);
        }

        return this.ctor('renderIconNode')(item);
    },

    renderToolbar()
    {
        if ( ! this.navigation ) {
            return null;
        }

        return (
            <KyoTitlebar class="col--flex-0-0" onDelete={this.deleteItems}>
                {
                    { search: () => <KyoTitlebarSearch vModel={this.query.search} /> }
                }
            </KyoTitlebar>
        );
    },

    renderFilterbar()
    {
        let rootButton = (
            <div class="col--auto">
                <NButton icon="fa fa-home" disabled={this.query.parent === this.root} onClick={this.gotoHome}>
                    { this.trans('Root') }
                </NButton>
            </div>
        )

        let aboveButton = (
            <div class="col--auto">
                <NButton icon="fa fa-arrow-up" disabled={this.query.parent === this.root} onClick={this.gotoParent}>
                    { this.trans('Above') }
                </NButton>
            </div>
        );

        let createFolder = (
            <div class="col--auto">
                <NButton type="success" icon="fa fa-folder" onClick={this.gotoCreate}>
                    { this.trans('Folder') }
                </NButton>
            </div>
        );

        let createVideo = (
            <div class="col--auto">
                <KyoVideos></KyoVideos>
            </div>
        );

        let createFile = (
            <div class="col--auto">
                <KyoUploads></KyoUploads>
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
                <NSelect vModel={this.query.prop} style="width: 140px;" options={sortOptions}>
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
                <NSelect vModel={this.query.dir} style="width: 140px;" options={orderOptions}>
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
            itemWidth: 150,
            itemHeight: 240,
            renderSelect: true,
            moveItems: false,
            deathzone: 50,
            threshold: 0,
            allowSelect: this.allowSelect,
            allowDrag: this.allowDrag,
            allowDrop: this.allowDrop,
            renderNode: this.ctor('renderNode'),
            'onMove': this.onMove,
            'onRowDblclick': this.gotoEdit,
            'onUpdate:current': (value) => this.current = value,
            'onUpdate:selected': (value) => this.selected = value
        }

        let paginatorProps = {
            page: this.query.page,
            limit: this.query.limit,
            total: this.result.total,
            layout: ['limit', 'count', 'spacer', 'goto', 'pages'],
            'onUpdate:page': (value) => this.query.page = value,
            'onUpdate:limit': (value) => this.query.limit = value
        }

        return (
            <div class="kyo-datagrid col--flex-1-0">
                <NDraggrid {...draggridProps} />
                <NPaginator {...paginatorProps} />
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
