import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoPackages',
    extends: window.KyoIndex,
    localized: true,
    refresh: false,

    urls: {
        index: '/{locale}/kyoto/package/http/controllers/package/index',
        delete: '/{locale}/kyoto/package/http/controllers/package/delete'
    },

    defaults()
    {
        let query = {
            prop: 'updated_at', dir: 'desc', columns: ['name']
        };

        return { query };
    },

    renderHeader()
    {
        let slots = {};

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
                type: 'state',
                prop: 'state',
                label: this.trans('State'),
                sort: true,
                filter: true,
                fixedWidth: 130
            },
            {
                type: 'link',
                prop: 'name',
                label: this.trans('Name'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
                modelValue: { name: 'KyoPackageEdit' }
            },
            {
                type: 'string',
                prop: 'description',
                label: this.trans('Description'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
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
            group: ['package'],
            onRowDblclick: this.gotoEdit,
            createText: this.trans('Create package'),
        }

        tableProps.onCreate = () => {
            this.$router.push({ name: 'KyoPackageCreate' });
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
