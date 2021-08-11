import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoPages',

    extends: window.KyoIndex,

    localized: true,

    urls: {
        index: '/{locale}/kyoto/page/http/controllers/page/index',
        delete: '/{locale}/kyoto/page/http/controllers/page/delete'
    },

    defaults() {

        let query = {
            page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title', 'content']
        };

        return { query };
    },

    mounted()
    {
        this.$root.showWebsite();
    },

    renderTitlebar()
    {
        let search = () => (
            <KyoTitlebarSearch vModel={this.query.search}/>
        );

        let gotoCreate = () => {
            this.$router.push({ name: 'KyoPageCreate' });
        }

        let action = () => (
            <NButton type="primary" onClick={gotoCreate}>
                { this.trans('Create page') }
            </NButton>
        );

        return (
            <KyoTitlebar class="col--flex-0-0" onDelete={this.deleteItems}>
                {{ search, action }}
            </KyoTitlebar>
        )
    },

    renderDatatable()
    {
        let columns = [
            {
                type: 'state',
                prop: 'state',
                label: this.trans('State'),
                sort: true,
                filter: true,
                fixedWidth: 130
            },
            {
                type: 'hide',
                prop: 'hide',
                label: this.trans('Hide'),
                sort: true,
                filter: true,
                fixedWidth: 150
            },
            {
                type: 'link',
                prop: 'title',
                label: this.trans('Title'),
                sort: true,
                filter: true,
                fluid: true,
                minWidth: 250,
                modelValue: { name: 'KyoPageEdit' }
            },
            {
                type: 'datetime',
                prop: 'updated_at',
                label: this.trans('Modified'),
                sort: true,
                filter: true,
                fixedWidth: 200
            },
            {
                type: 'datetime',
                prop: 'created_at',
                label: this.trans('Created'),
                sort: true,
                filter: true,
                fixedWidth: 200
            }
        ];

        let props = {
            group: ['page', 'transaction'],
            handle: true,
            renderHandle: true,
            onRowDblclick: this.gotoEdit
        }

        let table = () => {
            return Arr.each(columns, (props) => {
                return (<NTableColumn {...props} />);
            });
        }

        let keep = [
            'type', 'prop', 'label', 'modelValue'
        ];

        let info = () => {
            return Arr.each(columns, (props) => {
                return (<NInfoColumn {...Obj.only(props, keep)} />);
            });
        }

        return (
            <KyoDatatable class="col--flex-1-1" {...props}>
                {{ default: table, info: info }}
            </KyoDatatable>
        )
    },

    render()
    {
        return (
            <NLoader visible={this.load} class="full-height-child">
                <div class="grid grid--col">
                    { this.ctor('renderDatatable')() }
                </div>
            </NLoader>
        );
    }

}
