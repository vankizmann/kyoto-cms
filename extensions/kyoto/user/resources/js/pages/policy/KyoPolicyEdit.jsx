import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoPolicyEdit',

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
        show: '/{locale}/kyoto/user/http/controllers/policy/show',
        update: '/{locale}/kyoto/user/http/controllers/policy/update',
        delete: '/{locale}/kyoto/user/http/controllers/policy/delete'
    },

    methods: {

        gotoIndex()
        {
            this.$router.push({ name: 'KyoPolicies' });
        }

    },

    renderHeader()
    {
        let headerProps = {
            link: { name: 'KyoPolicies' }
        };

        return (
            <KyoHeader {...headerProps} />
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-policy-edit">
                <NFormGroup icon="fa fa-user-shield" label={this.trans('Policy')}>
                    <NFormItem label={this.trans('Title')} prop="title">
                        <NInput vModel={this.value.title} />
                    </NFormItem>
                    <NFormItem label={this.trans('Type')} prop="type">
                        <NInput vModel={this.value.type} />
                    </NFormItem>
                    <NFormItem label={this.trans('Action')} prop="action">
                        <NInput vModel={this.value.action} />
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
