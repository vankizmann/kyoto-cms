
export default {

    name: 'KyoMedias',

    extends: window.KyoIndex,

    localized: true,

    urls: {
        index: '/{locale}/kyoto/media/http/controllers/media/index',
        move: '/{locale}/kyoto/media/http/controllers/media/move',
        delete: '/{locale}/kyoto/media/http/controllers/media/delete'
    },

    defaults() {

        let query = {
            parent: '', page: 1, limit: 100, prop: 'title', dir: 'asc', filter: [], search: '', columns: ['title', 'type']
        };

        return { query };
    },

    data()
    {
        return { parent: null, filelist: [] }
    },

    beforeMount()
    {
        this.getParent();
    },

    mounted()
    {
        this.$watch('query.parent', this.loadItems);
        Nano.Event.bind('media:refresh', this.loadItems);
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

        addFile(file)
        {
            this.filelist.push({ id: this.UUID(), file: file });
        },

        setParent()
        {
            this.parent = Nano.Arr.last(this.result.breadcrumbs);
        },

        getParent()
        {
            this.query.parent = window.location.hash.replace(/^#/, '');
        },

        gotoHome()
        {
            this.$router.push({ name: 'KyoMedias' });
        },

        gotoParent()
        {
            if ( ! Nano.Obj.get(this.parent, 'above.id') ) {
                return this.gotoHome();
            }

            this.$router.push({
                name: 'KyoMedias', hash: `#${this.parent.above.id}`
            });
        },

        gotoFolder(row)
        {
            if ( ! Nano.Obj.get(row, 'item.id') ) {
                return this.gotoHome();
            }

            this.$router.push({
                name: 'KyoMedias', hash: `#${row.item.id}`
            });
        },

        gotoFile(row)
        {
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
            Nano.Arr.has(['system/folder', 'system/above'], row.item.type) ?
                this.gotoFolder(row) : this.gotoFile(row);
        },

        allowDrop(source, target)
        {
            if ( source.item.type === 'system/above' ) {
                return false;
            }

            return Nano.Arr.has(['system/folder', 'system/above'],
                Nano.Obj.get(target, 'item.type'));
        },

    },

    renderNode({ value })
    {
        let renderImage = (
            <div class="kyo-media-item__image">
                <img src={value.urls['square/sm']} alt={ value.name }/>
            </div>
        );

        let renderIcon = (
            <div class="kyo-media-item__icon" data-type={value.type}>
                <span>{ value.type.match(/^system\//) ? value.count : value.type.replace(/^(.*?)\//, '')}</span>
            </div>
        );

        return (
            <div class="kyo-media-item">
                { value.type.match(/^image\//) ? renderImage : renderIcon }
                <div class="kyo-media-item__title">
                    { value.title }
                </div>
                <div class="kyo-media-item__meta">
                    { value.type }
                </div>
            </div>
        );
    },

    render()
    {
        let datagridProps = {
            current: this.current,
            selected: this.selected,
            items: this.result.data,
            uniqueProp: 'uid',
            itemHeight: 215,
            renderSelect: true,
            insertNode: false,
            removeNode: false,
            moveItems: false,
            allowDrop: this.allowDrop,
            renderNode: this.ctor('renderNode')
        }

        let datagridEvents = {
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
            <NLoader visible={this.load} class="full-height-child">

                <div class="grid grid--col">

                    <KyoTitlebar class="col--flex-0-0" vOn:delete={this.deleteItems}>

                        <template slot="search">
                            <KyoTitlebarSearch vModel={this.query.search} />
                        </template>

                        <template slot="action">
                            <NButton>{ this.trans('Add files')}</NButton>
                        </template>

                    </KyoTitlebar>

                    <KyoFilterbar class="col--flex-0-0">
                        <div class="grid grid--row grid--10">

                            <div class="col--auto">
                                <NButton icon="fa fa-home" disabled={!this.query.parent} vOn:click={this.gotoHome}>
                                    { this.trans('Root') }
                                </NButton>
                            </div>

                            <div class="col--auto">
                                <NButton icon="fa fa-arrow-up" disabled={!this.query.parent} vOn:click={this.gotoParent}>
                                    { this.trans('Above') }
                                </NButton>
                            </div>

                            <div class="col--auto">
                                <div style="width: 10px;"></div>
                            </div>

                            <div class="col--auto ">
                                <NButton type="success" icon="fa fa-folder" vOn:click={this.gotoCreate}>
                                    { this.trans('New folder') }
                                </NButton>
                            </div>

                            <div class="col--auto">
                                <KyoVideos></KyoVideos>
                            </div>

                            <div class="col--auto">
                                <KyoUploads></KyoUploads>
                            </div>

                            <div class="col--auto col--right">
                                <NSelect style="width: 200px;">
                                    <NSelectOption value="1">Testitem</NSelectOption>
                                    <NSelectOption value="2">Testitem</NSelectOption>
                                    <NSelectOption value="3">Testitem</NSelectOption>
                                    <NSelectOption value="4">Testitem</NSelectOption>
                                    <NSelectOption value="5">Testitem</NSelectOption>
                                </NSelect>
                            </div>

                        </div>
                    </KyoFilterbar>

                    <div class="kyo-datatable col--flex-1-0">
                        <NDraggrid class="kyo-medias" props={datagridProps} on={datagridEvents} />
                        <NPaginator props={paginatorProps} on={paginatorEvents} />
                    </div>

                </div>

            </NLoader>
        )
    }
}
