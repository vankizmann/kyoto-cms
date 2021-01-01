
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
            parent: '', page: 1, limit: 100, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
        };

        return { query };
    },

    data()
    {
        return { filelist: [] }
    },

    mounted()
    {
        Nano.Event.bind('media:refresh', this.loadItems);
    },

    watch: {

        'query.parent': function () {
            this.loadItems();
        },

    },

    methods: {

        addFile(file)
        {
            this.filelist.push({ id: this.UUID(), file: file });
        },

        gotoFolder(row)
        {
            this.query.parent = row.item.id;
        },

        gotoFile(row)
        {
            this.$router.push({
                name: this.__self(null, 'Edit'), params: row.item
            });
        },

        /**
         * Goto edit form
         * @param row
         */
        gotoEdit(row)
        {
            if ( row.item.type === 'system/folder' ) {
                return this.gotoFolder(row);
            }

            this.gotoFile(row);
        }

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
                { /* Nice icon */}
            </div>
        );

        return (
            <div class={['kyo-media-item', 'kyo-media-item--' + value.type]}>
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
            selected: this.selected,
            items: this.result.data,
            itemHeight: 0,
            renderSelect: true,
            allowCurrent: false,
            renderNode: this.ctor('renderNode')
        }

        let datagridEvents = {
            'update:selected': (value) => this.selected = value,
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
                            <NButton>{ this.trans('Create folder')}</NButton>
                        </template>

                    </KyoTitlebar>

                    <KyoFilterbar class="col--flex-0-0">

                        <NSelect style="width: 200px;">
                            <NSelectOption value="1">Testitem</NSelectOption>
                            <NSelectOption value="2">Testitem</NSelectOption>
                            <NSelectOption value="3">Testitem</NSelectOption>
                            <NSelectOption value="4">Testitem</NSelectOption>
                            <NSelectOption value="5">Testitem</NSelectOption>
                        </NSelect>

                    </KyoFilterbar>

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
