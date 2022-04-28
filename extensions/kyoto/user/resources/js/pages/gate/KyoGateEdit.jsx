import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoGateEdit',

    /**
     * Extend KyoForm
     */
    extends: window.KyoForm,

    /**
     * Refresh on locale change (true|false)
     */
    localized: true,

    /**
     * Refresh website on save (true|false)
     */
    refresh: false,

    /**
     * Used routes in view
     */
    urls: {
        show: '/{locale}/kyoto/user/http/controllers/gate/show',
        update: '/{locale}/kyoto/user/http/controllers/gate/update',
        delete: '/{locale}/kyoto/user/http/controllers/gate/delete'
    },

    methods: {

        gotoIndex()
        {
            this.$router.push({ name: 'KyoGates' });
        }

    },

    renderHeader()
    {
        let headerProps = {
            link: { name: 'KyoGates' }
        };

        return (
            <KyoHeader {...headerProps} />
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-gate-edit">
                <NFormGroup icon="fa fa-paragraph" label={this.trans('Info')}>
                    <NFormItem label={this.trans('Title')} prop="title">
                        <NInput vModel={this.value.title} />
                    </NFormItem>
                    <NFormItem label={this.trans('Description')} prop="description">
                        <NTextarea vModel={this.value.description} min-rows={2} auto-rows={true} />
                    </NFormItem>
                </NFormGroup>
            </div>
        );
    },

    renderSidebar()
    {
        return [];
    },

    renderDataform()
    {
        let slots = {
            default: this.ctor('renderContent'),
            header: this.ctor('renderHeader'),
            sidebar: this.ctor('renderSidebar'),
        };

        let formProps = {
            relative: false,
            defaultCollapse: [],
            showDelete: !this.isCreate,
        };

        return (
            <KyoDataform class="col--flex-1-1" {...formProps} v-slots={slots} />
        );
    },

    render()
    {
        return (
            <NLoader visible={this.load} class="full-height-child">
                {this.ctor('renderDataform')()}
            </NLoader>
        );
    }

}
