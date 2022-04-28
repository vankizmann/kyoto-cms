import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoRoleEdit',

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
        show: '/{locale}/kyoto/user/http/controllers/role/show',
        update: '/{locale}/kyoto/user/http/controllers/role/update',
        delete: '/{locale}/kyoto/user/http/controllers/role/delete'
    },

    methods: {

        gotoIndex()
        {
            this.$router.push({ name: 'KyoRoles' });
        }

    },

    renderHeader()
    {
        let headerProps = {
            link: { name: 'KyoRoles' }
        };

        return (
            <KyoHeader {...headerProps} />
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-role-edit">
                <NFormGroup icon="fa fa-paragraph" label={this.trans('Info')}>
                    <NFormItem label={this.trans('Title')} prop="title">
                        <NInput vModel={this.value.title} />
                    </NFormItem>
                    <NFormItem label={this.trans('Description')} prop="description">
                        <NTextarea vModel={this.value.description} min-rows={2} auto-rows={true} />
                    </NFormItem>
                </NFormGroup>
                <NFormGroup icon="fa fa-user-shield" label={this.trans('Access')}>
                    <NFormItem label={this.trans('Policies')} prop="policies">
                        <KyoPolicyTransfer vModel={this.value.policies} />
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
