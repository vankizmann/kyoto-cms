import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoTranslations',
    extends: window.KyoIndex,
    localized: true,
    refresh: false,

    urls: {
        index: '/{locale}/kyoto/language/http/controllers/translation/index',
        delete: '/{locale}/kyoto/language/http/controllers/translation/delete'
    },

    defaults()
    {
        let query = {
            prop: 'updated_at', dir: 'desc', columns: ['source', 'target']
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
                prop: 'source',
                label: this.trans('Source'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
                modelValue: { name: 'KyoTranslationEdit' }
            },
            {
                type: 'string',
                prop: 'target',
                label: this.trans('Target'),
                sort: true,
                filter: true,
                fluid: true,
                width: 250,
                modelValue: { name: 'KyoTranslationEdit' }
            },
            {
                type: 'string',
                prop: 'package',
                label: this.trans('Package'),
                sort: true,
                filter: true,
                fluid: true,
                width: 120,
                modelValue: { name: 'KyoTranslationEdit' }
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
            group: ['translation'],
            onRowDblclick: this.gotoEdit,
            createText: this.trans('Create translation'),
        }

        tableProps.onCreate = () => {
            this.$router.push({ name: 'KyoTranslationCreate' });
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
