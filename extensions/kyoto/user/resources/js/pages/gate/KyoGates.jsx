import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoGates',
    extends: window.KyoIndex,
    localized: true,
    refresh: false,

    urls: {
        index: '/{locale}/kyoto/user/http/controllers/gate/index',
        delete: '/{locale}/kyoto/user/http/controllers/gate/delete'
    },

    defaults()
    {
        let query = {
            prop: 'updated_at', dir: 'desc', columns: ['title', 'description']
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
                type: 'link',
                prop: 'title',
                label: this.trans('Title'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
                modelValue: { name: 'KyoGateEdit' }
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
            group: ['gate'],
            onRowDblclick: this.gotoEdit,
            createText: this.trans('Create gate'),
        }

        tableProps.onCreate = () => {
            this.$router.push({ name: 'KyoGateCreate' });
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
