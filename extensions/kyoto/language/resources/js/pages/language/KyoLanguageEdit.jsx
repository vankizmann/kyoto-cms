import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoLanguageEdit',

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
        show: '/{locale}/kyoto/language/http/controllers/language/show',
        update: '/{locale}/kyoto/language/http/controllers/language/update',
        delete: '/{locale}/kyoto/language/http/controllers/language/delete'
    },

    methods: {

        gotoIndex()
        {
            this.$router.push({ name: 'KyoLanguages' });
        }

    },

    renderHeader()
    {
        let headerProps = {
            link: { name: 'KyoLanguages' }
        };

        return (
            <KyoHeader {...headerProps} />
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-gate-edit">
                <NFormGroup icon="fa fa-language" label={this.trans('Language')}>
                    <NFormItem label={this.trans('Language')} prop="language">
                        <NInput vModel={this.value.language} />
                    </NFormItem>
                    <NFormItem label={this.trans('Country')} prop="country">
                        <NInput vModel={this.value.country} />
                    </NFormItem>
                    <NFormItem label={this.trans('Locale')} prop="locale">
                        <NInput vModel={this.value.locale} />
                    </NFormItem>
                    <NFormItem label={this.trans('Plate')} prop="plate">
                        <NInput vModel={this.value.plate} />
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
                        {this.trans('Language is enabled')}
                    </NSwitch>
                </NFormItem>
                <NFormItem label={this.trans('Hide')} prop="hide">
                    <NSwitch v-model={this.value.hide} on-value={1} off-value={0}>
                        {this.trans('Language is hidden')}
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
