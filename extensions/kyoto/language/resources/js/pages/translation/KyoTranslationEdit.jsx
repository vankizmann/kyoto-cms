import { Arr, Obj } from "@kizmann/pico-js";

export default {

    name: 'KyoTranslationEdit',

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
        show: '/{locale}/kyoto/language/http/controllers/translation/show',
        update: '/{locale}/kyoto/language/http/controllers/translation/update',
        delete: '/{locale}/kyoto/language/http/controllers/translation/delete'
    },

    methods: {

        gotoIndex()
        {
            this.$router.push({ name: 'KyoTranslations' });
        }

    },

    renderHeader()
    {
        let headerProps = {
            link: { name: 'KyoTranslations' }
        };

        return (
            <KyoHeader {...headerProps} />
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-translation-edit">
                <NFormGroup icon="fa fa-language" label={this.trans('Translation')}>
                    <NFormItem label={this.trans('Source')} prop="source">
                        <NTextarea disabled={!this.isCreate} vModel={this.value.source} />
                    </NFormItem>
                    <NFormItem label={this.trans('Target')} prop="target">
                        <NTextarea vModel={this.value.target} />
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
                        {this.trans('Translation is enabled')}
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
