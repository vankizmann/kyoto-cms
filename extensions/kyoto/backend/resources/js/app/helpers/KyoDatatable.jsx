export default {

    name: 'KyoDatatable',

    inject: {

        KyoIndex: {
            default: undefined
        }

    },

    props: {

        group: {
            default()
            {
                return ['default'];
            },
            type: [Array]
        },

        allowGroups: {
            default()
            {
                return ['default'];
            },
            type: [Array]
        },

        handle: {
            default()
            {
                return false;
            },
            type: [Boolean]
        },

        renderHandle: {
            default()
            {
                return false;
            },
            type: [Boolean]
        },

        renderExpand: {
            default()
            {
                return false;
            },
            type: [Boolean]
        },

        renderPagination: {
            default()
            {
                return true;
            },
            type: [Boolean]
        },

    },

    methods: {

        setWidth(width)
        {
            pi.Event.fire('datatable:resize', width);

            pi.Dom.find(window).fire('resize')
        },

        onRowDblclick(...args)
        {
            this.$emit('row-dblclick', ...args);
        },

    },

    renderHeader()
    {
        return (
            <div><h2>HALLO!!</h2></div>
        )
    },

    renderAction()
    {

    },

    renderInfo()
    {
        if ( ! this.$slots.info ) {
            return;
        }

        let infoProps = {
            item: this.KyoIndex.current
        };

        let infoSlots = {
            default: this.$slots.info,
        };

        return (
            <NInfo ref="info" {...infoProps} v-slots={infoSlots} />
        )
    },

    renderExtra()
    {

    },

    renderTable()
    {
        if ( ! this.$slots.default ) {
            return;
        }

        let tableProps = {
            current: this.KyoIndex.current,
            selected: this.KyoIndex.selected,
            expanded: this.KyoIndex.expanded,
            allowDrag: this.KyoIndex.allowDrag,
            allowDrop: this.KyoIndex.allowDrop,
            safezone: this.KyoIndex.safezone,
            onMove: this.KyoIndex.onMove,
            items: this.KyoIndex.result.data,
            filter: this.KyoIndex.query.filter,
            sortProp: this.KyoIndex.query.prop,
            sortDir: this.KyoIndex.query.dir,
            handle: this.handle,
            renderHandle: this.renderHandle,
            renderExpand: this.renderExpand,
            group: this.group,
            allowGroups: this.allowGroups,
            onRowDblclick: this.onRowDblclick,
            itemHeight: 40,
            threshold: 501,
        };

        tableProps['onUpdate:current'] = (value) => {
            this.KyoIndex.current = value;
        };

        tableProps['onUpdate:selected'] = (value) => {
            this.KyoIndex.selected = value;
        };

        tableProps['onUpdate:expanded'] = (value) => {
            this.KyoIndex.expanded = value;
        };

        tableProps['onUpdate:filter'] = (value) => {
            this.KyoIndex.query.filter = value;
        };

        tableProps['onUpdate:sortProp'] = (value) => {
            this.KyoIndex.query.prop = value;
        };

        tableProps['onUpdate:sortDir'] = (value) => {
            this.KyoIndex.query.dir = value;
        };

        let tableSlots = {
            default: this.$slots.default,
        }

        return (
            <NTable ref="table" {...tableProps} v-slots={tableSlots} />
        );
    },

    renderPaging()
    {
        let pagingProps = {
            page: this.KyoIndex.query.page,
            limit: this.KyoIndex.query.limit,
            total: this.KyoIndex.result.total,
            layout: ['limit', 'count', 'spacer', 'goto', 'pages']
        };

        if ( ! this.renderPagination ) {
            pagingProps.layout = ['count'];
        }

        pagingProps['onUpdate:page'] = (value) => {
            this.KyoIndex.query.page = value;
        };

        return (
            <NPaginator {...pagingProps} />
        );
    },

    render()
    {
        let resizerProps = {
            width: 320, position: 'left'
        };

        resizerProps['onUpdate:modelValue'] = this.setWidth;

        return (
            <div class="kyo-datatable">
                <div class="kyo-datatable__body">
                    {
                        [
                            this.ctor('renderHeader')(),
                            this.ctor('renderTable')(),
                            this.ctor('renderPaging')(),
                        ]
                    }
                </div>
                <NResizer class="kyo-datatable__side" {...resizerProps}>
                    <NScrollbar>
                        {
                            [
                                this.ctor('renderAction')(),
                                this.ctor('renderInfo')(),
                                this.ctor('renderExtra')(),
                            ]
                        }
                    </NScrollbar>
                </NResizer>
            </div>
        )
    }

}
