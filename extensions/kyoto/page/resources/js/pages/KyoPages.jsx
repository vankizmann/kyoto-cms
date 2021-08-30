import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name:      'KyoPages',
    extends:   window.KyoIndex,
    localized: true,
    refresh:   true,

    urls: {
        index:  '/{locale}/kyoto/page/http/controllers/page/index',
        delete: '/{locale}/kyoto/page/http/controllers/page/delete'
    },

    defaults()
    {
        let query = {
            page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title', 'content']
        };

        return { query };
    },

    renderHeader()
    {
        let slots = {};

        let gotoCreate = () => {
            this.$router.push({ name: 'KyoPageCreate' });
        }

        slots.action = (
            <NButton onClick={gotoCreate}>
                {this.trans('Create page')}
            </NButton>
        );

        slots.search = (
            <KyoSearch vModel={this.query.search} />
        );

        return (
            <KyoHeader v-slots={slots} />
        );
    },

    renderDatatable()
    {
        let slots = {};

        let columns = [
            {
                type:       'state',
                prop:       'state',
                label:      this.trans('State'),
                sort:       true,
                filter:     true,
                fixedWidth: 130
            },
            {
                type:       'hide',
                prop:       'hide',
                label:      this.trans('Hide'),
                sort:       true,
                filter:     true,
                fixedWidth: 150
            },
            {
                type:       'link',
                prop:       'title',
                label:      this.trans('Title'),
                sort:       true,
                filter:     true,
                fluid:      true,
                minWidth:   250,
                modelValue: { name: 'KyoPageEdit' }
            },
            {
                type:       'datetime',
                prop:       'updated_at',
                label:      this.trans('Modified'),
                sort:       true,
                filter:     true,
                fixedWidth: 200
            },
            {
                type:       'datetime',
                prop:       'created_at',
                label:      this.trans('Created'),
                sort:       true,
                filter:     true,
                fixedWidth: 200
            }
        ];

        slots.default = () => {
            return Arr.each(columns, (props) => {
                return (<NTableColumn {...props} />);
            });
        }

        let keep = [
            'type', 'prop', 'label'
        ];

        slots.info = () => {
            return Arr.each(columns, (props) => {
                return (<NInfoColumn {...Obj.only(props, keep)} />);
            });
        }

        slots.header = this.ctor('renderHeader');

        let tableProps = {
            group:         ['page', 'transaction'],
            handle:        true,
            renderHandle:  true,
            onRowDblclick: this.gotoEdit
        }

        return (
            <KyoDatatable class="col--flex-1-1" {...tableProps} v-slots={slots} />
        );
    },

    render()
    {
        return (
            <NLoader visible={this.load} class="full-height-child">
                {this.ctor('renderDatatable')()}
            </NLoader>
        );
    }

}
