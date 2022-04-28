import { Locale } from "@kizmann/pico-js";

export default {

    name: 'KyoDatatable',

    inject: {

        KyoIndex: {
            default: undefined
        }

    },

    props: {

        showCreate: {
            default()
            {
                return true;
            },
            type: [Boolean]
        },

        showCopy: {
            default()
            {
                return false;
            },
            type: [Boolean]
        },

        showDelete: {
            default()
            {
                return true;
            },
            type: [Boolean]
        },

        createText: {
            default()
            {
                return Locale.trans('Create new');
            },
            type: [String]
        },

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

    data()
    {
        return {
            collapse: ['info'], copyConfirm: false, deleteConfirm: false,
        };
    },

    methods: {

        setWidth()
        {
            pi.Dom.find(window).fire('resize')
        },

        onRowDblclick(...args)
        {
            this.$emit('row-dblclick', ...args);
        },

    },

    renderHeader()
    {
        if ( ! this.$slots.header ) {
            return null;
        }

        return (
            <div class="kyo-datatable__header">
                {this.$slots.header()}
            </div>
        );
    },

    renderCreate()
    {
        if ( ! this.showCreate ) {
            return null;
        }

        let buttonProps = {
            class: 'solid',
            type: 'primary',
        };

        buttonProps.onClick = () => {
            this.$emit('create');
        };

        let buttonHtml = (
            <NButton {...buttonProps}>
                {this.createText}
            </NButton>
        );

        return (
            <div class="kyo-datatable-topbar__create">
                {buttonHtml}
            </div>
        );
    },

    renderCopy()
    {
        if ( ! this.showCopy ) {
            return null;
        }

        let buttonProps = {
            type: 'primary',
            icon: 'fa fa-clone',
        };

        buttonProps['onClick'] = () => {
            this.copyConfirm = true;
        };

        if ( this.KyoIndex.selected.length === 0 ) {
            buttonProps.disabled = true;
        }

        let buttonHtml = (
            <NButton {...buttonProps}>
                {this.trans('Copy')}
            </NButton>
        );

        let confirmProps = {
            type: 'primary',
            listen: false,
        };

        confirmProps['onConfirm'] = () => {
            this.KyoIndex.copyItems();
        };

        let choice = [
            'Do you really want copy :count item',
            'Do you really want copy :count items'
        ];

        let confirmHtml = (
            <NConfirm vModel={this.copyConfirm} {...confirmProps}>
                { this.choice(choice.join('|'), this.KyoIndex.selected.length)}
            </NConfirm>
        );

        return (
            <div class="kyo-datatable-topbar__copy">
                {[buttonHtml, confirmHtml]}
            </div>
        );
    },

    renderDelete()
    {
        if ( ! this.showDelete ) {
            return null;
        }

        let buttonProps = {
            type: 'danger',
            icon: 'fa fa-minus-circle',
        };

        buttonProps['onClick'] = () => {
            this.deleteConfirm = true;
        };

        if ( this.KyoIndex.selected.length === 0 ) {
            buttonProps.disabled = true;
        }

        let buttonHtml = (
            <NButton {...buttonProps}>
                {this.trans('Delete')}
            </NButton>
        );

        let confirmProps = {
            type: 'danger',
            listen: false,
        };

        confirmProps['onConfirm'] = () => {
            this.KyoIndex.deleteItems();
        };

        let choice = [
            'Do you really want delete :count item',
            'Do you really want delete :count items'
        ];

        let confirmHtml = (
            <NConfirm vModel={this.deleteConfirm} {...confirmProps}>
                { this.choice(choice.join('|'), this.KyoIndex.selected.length)}
            </NConfirm>
        );

        return (
            <div class="kyo-datatable-topbar__delete">
                {[buttonHtml, confirmHtml]}
            </div>
        );
    },

    renderTopbar()
    {
        let choice = [
            'No item selected',
            ':count item selected',
            ':count items selected'
        ];

        let singleText = (
            <KyoBreadcrumbs class="kyo-datatable-topbar__bread" />
        );

        let multiText = (
            <div class="kyo-datatable-topbar__text">
                { this.choice(choice.join('|'), this.KyoIndex.selected.length)}
            </div>
        );

        let renderInfo = singleText;

        if ( this.KyoIndex.selected.length ) {
            renderInfo = multiText;
        }

        return (
            <div class="kyo-datatable-topbar">
                {[renderInfo, this.ctor('renderCopy')(), this.ctor('renderDelete')(), this.ctor('renderCreate')()]}
            </div>
        );
    },

    renderAction()
    {
        if ( ! this.$slots.action ) {
            return;
        }

        let sideHead = (
            <div class="kyo-datatable-side__head">
                <h6>{this.trans('Action')}</h6>
            </div>
        );

        let sideBody = (
            <div class="kyo-datatable-side__body">
                {this.$slots.action()}
            </div>
        );

        return (
            <div class="kyo-datatable-side__item kyo-datatable-action">
                {[sideHead, sideBody]}
            </div>
        );
    },

    renderInfo()
    {
        if ( ! this.$slots.info ) {
            return;
        }

        let sideHead = (
            <div class="kyo-datatable-side__head">
                <h6>{this.trans('Information')}</h6>
            </div>
        );

        let infoProps = {
            item: this.KyoIndex.current
        };

        let infoSlots = {
            default: this.$slots.info,
        };

        let sideBody = (
            <div class="kyo-datatable-side__body clear">
                <NInfo ref="info" {...infoProps} v-slots={infoSlots} />
            </div>
        );

        let collapseProps = {
            name: 'info', label: this.trans('Information'),
        };

        return (
            <NCollapseItem {...collapseProps}>
                {sideBody}
            </NCollapseItem>
        );
    },

    renderExtra()
    {
        if ( ! this.$slots.extra ) {
            return;
        }

        let sideHead = (
            <div class="kyo-datatable-side__head">
                <h6>{this.trans('Extras')}</h6>
            </div>
        );

        let sideBody = (
            <div class="kyo-datatable-side__body">
                {this.$slots.extra()}
            </div>
        );

        return (
            <div class="kyo-datatable-side__item kyo-datatable-extra">
                {[sideHead, sideBody]}
            </div>
        );
    },

    renderContent()
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

        pagingProps['onUpdate:limit'] = (value) => {
            this.KyoIndex.query.limit = value;
        };

        return (
            <NPaginator {...pagingProps} />
        );
    },

    render()
    {
        let resizerProps = {
            width: 345,
            minWidth: 320,
            maxWidth: 640,
            position: 'left'
        };

        resizerProps['onUpdate:modelValue'] = (value) => {
            this.setWidth(value);
        };

        return (
            <div class="kyo-datatable">
                <div class="kyo-datatable__head">
                    {this.ctor('renderTopbar')()}
                </div>
                <div class="kyo-datatable__body">
                    {
                        [
                            this.ctor('renderHeader')(),
                            this.ctor('renderContent')(),
                            this.ctor('renderPaging')(),
                        ]
                    }
                </div>
                <NResizer class="kyo-datatable__side" {...resizerProps}>
                    <NScrollbar wrapClass="kyo-datatable-side">
                        <NCollapse vModel={this.collapse}>
                            {
                                [
                                    this.ctor('renderAction')(),
                                    this.ctor('renderInfo')(),
                                    this.ctor('renderExtra')(),
                                ]
                            }
                        </NCollapse>
                    </NScrollbar>
                </NResizer>
            </div>
        );
    }

}
