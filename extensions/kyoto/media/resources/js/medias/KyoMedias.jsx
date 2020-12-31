
export default {

    name: 'KyoMedias',

    extends: window.KyoIndex,

    localized: true,

    urls: {
        index: '/{locale}/kyoto/media/http/controllers/media/index',
        delete: '/{locale}/kyoto/media/http/controllers/media/delete'
    },

    defaults() {

        let query = {
            page: 1, limit: 100, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
        };

        return { query };
    },

    data()
    {
        return { filelist: [] }
    },

    mounted()
    {

    },

    methods: {

        addFile(file)
        {
            this.filelist.push({ id: this.UUID(), file: file });
        }

    },

    renderNode({ value })
    {
        return (
            <div class={['kyo-media-item', 'kyo-media-item--' + value.type]}>
                <div class="kyo-media-item__image">

                </div>
                <div class="kyo-media-item__title">
                    { value.title }
                </div>
                <div class="kyo-media-item__meta">
                    { value.description || '-' }
                </div>
            </div>
        );
    },

    render()
    {
        let datagridProps = {
            selected: this.selected,
            items: this.result.data,
            itemHeight: 190,
            renderSelect: true,
            allowCurrent: false,
            renderNode: this.ctor('renderNode')
        }

        let datagridEvents = {
            'update:selected': (value) => this.selected = value
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
                            <NButton>{ this.trans('Create folder')}</NButton>
                        </template>

                    </KyoTitlebar>

                    <div class="kyo-datatable col--flex-1-0">
                        <NDraggrid class="kyo-medias" props={datagridProps} on={datagridEvents} />
                        <NPaginator props={paginatorProps} on={paginatorEvents} />
                    </div>

                </div>

                <KyoUploads></KyoUploads>
            </NLoader>
        )
    }
}
