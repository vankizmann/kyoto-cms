import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoUserEdit',

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
        show: '/{locale}/kyoto/user/http/controllers/user/show',
        update: '/{locale}/kyoto/user/http/controllers/user/update',
        delete: '/{locale}/kyoto/user/http/controllers/user/delete'
    },

    methods: {

        gotoIndex()
        {
            this.$router.push({ name: 'KyoUsers' });
        }

    },

    renderHeader()
    {
        let headerProps = {
            link: { name: 'KyoUsers' }
        };

        return (
            <KyoHeader {...headerProps} />
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-user-edit">
                <NFormGroup icon="fa fa-user" label={this.trans('User')}>
                    <NFormItem label={this.trans('Name')} prop="name">
                        <NInput vModel={this.value.name} />
                    </NFormItem>
                    <NFormItem label={this.trans('E-Mail')} prop="email">
                        <NInput vModel={this.value.email} />
                    </NFormItem>
                </NFormGroup>
                <NFormGroup icon="fa fa-user-shield" label={this.trans('Access')}>
                    <NFormItem label={this.trans('Role')} prop="role_id">
                        <KyoRoleSelect vModel={this.value.role_id} />
                    </NFormItem>
                    <NFormItem label={this.trans('Gate')} prop="gate_id">
                        <KyoGateSelect vModel={this.value.gate_id} />
                    </NFormItem>
                </NFormGroup>
                <NFormGroup icon="fa fa-key" label={this.trans('Security')}>
                    <NFormItem label={this.trans('Password')} prop="fooword">
                        <NInput vModel={this.value.fooword} />
                    </NFormItem>
                    <NFormItem label={this.trans('Password confirmation')} prop="fooword_confirm">
                        <NInput vModel={this.value.fooword_confirm} />
                    </NFormItem>
                </NFormGroup>
            </div>
        );
    },

    renderSidebar()
    {
        let settings = (
            <NCollapseItem label={this.trans('Settings')} name="settings" icon="fa fa-cogs">
                <NFormItem label={this.trans('State')} prop="state">
                    <NSwitch v-model={this.value.state} on-value={1} off-value={0}>
                        {this.trans('User is enabled')}
                    </NSwitch>
                </NFormItem>
            </NCollapseItem>
        );


        return [settings];
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
            defaultCollapse: ['settings'],
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
