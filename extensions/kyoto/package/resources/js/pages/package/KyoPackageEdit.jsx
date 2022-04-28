import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoPackageEdit',

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
        show: '/{locale}/kyoto/package/http/controllers/package/show',
        update: '/{locale}/kyoto/package/http/controllers/package/update',
        delete: '/{locale}/kyoto/package/http/controllers/package/delete'
    },

    methods: {

        gotoIndex()
        {
            this.$router.push({ name: 'KyoPackages' });
        }

    },

    renderHeader()
    {
        let headerProps = {
            link: { name: 'KyoPackages' }
        };

        return (
            <KyoHeader {...headerProps} />
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-package-edit">
                <NFormGroup icon="fa fa-box" label={this.trans('Package')}>
                    <NFormItem label={this.trans('Name')} prop="name">
                        <NInput vModel={this.value.name} disabled={true}/>
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
                        {this.trans('Package is enabled')}
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
