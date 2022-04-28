import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoLanguages',
    extends: window.KyoIndex,
    localized: true,
    refresh: false,

    urls: {
        index: '/{locale}/kyoto/language/http/controllers/language/index',
        delete: '/{locale}/kyoto/language/http/controllers/language/delete'
    },

    defaults()
    {
        let query = {
            prop: 'updated_at', dir: 'desc', columns: ['language', 'country', 'locale']
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
                type: 'hide',
                prop: 'hide',
                label: this.trans('Hidden'),
                sort: true,
                filter: true,
                fixedWidth: 130
            },
            {
                type: 'link',
                prop: 'language',
                label: this.trans('Language'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
                modelValue: { name: 'KyoLanguageEdit' }
            },
            {
                type: 'string',
                prop: 'country',
                label: this.trans('Country'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
                visible: false,
            },
            {
                type: 'string',
                prop: 'locale',
                label: this.trans('Locale'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
            },
            {
                type: 'string',
                prop: 'plate',
                label: this.trans('Plate'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
                visible: false,
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
            group: ['language'],
            onRowDblclick: this.gotoEdit,
            createText: this.trans('Create language'),
        }

        tableProps.onCreate = () => {
            this.$router.push({ name: 'KyoLanguageCreate' });
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
