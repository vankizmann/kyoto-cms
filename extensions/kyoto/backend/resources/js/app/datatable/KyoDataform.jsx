import { Locale } from "@kizmann/pico-js";

export default {

    name: 'KyoDataform',

    inject: {

        KyoForm: {
            default: undefined
        }

    },

    props: {

        relative: {
            default()
            {
                return false;
            },
            type: [Boolean]
        },

        showDelete: {
            default()
            {
                return true;
            },
            type: [Boolean]
        },

        showApply: {
            default()
            {
                return true;
            },
            type: [Boolean]
        },

        showSave: {
            default()
            {
                return true;
            },
            type: [Boolean]
        },

        deleteText: {
            default()
            {
                return Locale.trans('Delete');
            },
            type: [String]
        },

        applyText: {
            default()
            {
                return Locale.trans('Apply');
            },
            type: [String]
        },

        saveText: {
            default()
            {
                return Locale.trans('Save');
            },
            type: [String]
        },

        defaultCollapse: {
            default()
            {
                return [];
            },
            type: [Array]
        }

    },

    data()
    {
        return {
            collapse: this.defaultCollapse, deleteConfirm: false,
        };
    },

    methods: {

        setWidth()
        {
            pi.Dom.find(window).fire('resize')
        },

    },

    renderHeader()
    {
        if ( !this.$slots.header ) {
            return null;
        }

        return (
            <div class="kyo-dataform__header">
                {this.$slots.header()}
            </div>
        );
    },

    renderApply()
    {
        if ( !this.showApply ) {
            return null;
        }

        let buttonProps = {
            class: 'solid',
            type: 'primary',
        };

        buttonProps.onClick = () => {
            this.KyoForm.applyItem();
        };

        return (
            <NButton {...buttonProps}>
                {this.applyText}
            </NButton>
        );
    },

    renderSave()
    {
        if ( !this.showSave ) {
            return null;
        }

        let buttonProps = {
            class: 'solid',
            type: 'primary',
        };

        buttonProps.onClick = () => {
            this.KyoForm.saveItem();
        };

        return (
            <NButton {...buttonProps}>
                {this.saveText}
            </NButton>
        );
    },

    renderDelete()
    {
        if ( !this.showDelete ) {
            return null;
        }

        let buttonProps = {
            type: 'danger',
            icon: 'fa fa-minus-circle',
        };

        buttonProps['onClick'] = () => {
            this.deleteConfirm = true;
        };

        let buttonHtml = (
            <NButton {...buttonProps}>
                {this.trans('Delete')}
            </NButton>
        );

        let confirmProps = {
            type: 'danger',
            listen: false,
        };

        confirmProps['onConfirm'] = () => {
            this.KyoIndex.deleteItem();
        };

        let confirmHtml = (
            <NConfirm vModel={this.deleteConfirm} {...confirmProps}>
                {this.trans('Do you really want delete this item')}
            </NConfirm>
        );

        return (
            <div class="kyo-dataform-topbar__delete">
                {[buttonHtml, confirmHtml]}
            </div>
        );
    },

    renderTopbar()
    {
        let renderInfo = (
            <KyoBreadcrumbs class="kyo-dataform-topbar__bread" />
        );

        let renderButton = (
            <NButtonGroup class="kyo-dataform-topbar__save">
                {[this.ctor('renderApply')(), this.ctor('renderSave')()]}
            </NButtonGroup>
        )

        return (
            <div class="kyo-dataform-topbar">
                {[renderInfo, this.ctor('renderDelete')(), renderButton]}
            </div>
        );
    },

    renderHead()
    {
        return (
            <div className="kyo-dataform__head">
                {this.ctor('renderTopbar')()}
            </div>
        );
    },

    renderContent()
    {
        return (
            <div class="kyo-dataform-content">
                {this.$slots.default && this.$slots.default()}
            </div>
        );
    },

    renderSidebar()
    {
        if ( !this.$slots.sidebar ) {
            return null;
        }

        let resizerProps = {
            width: 345,
            minWidth: 320,
            maxWidth: 640,
            position: 'left'
        };

        resizerProps['onUpdate:modelValue'] = (value) => {
            this.setWidth(value);
        };

        return (
            <NResizer class="kyo-dataform__side" {...resizerProps}>
                <NScrollbar wrapClass="kyo-dataform-side">
                    <NCollapse vModel={this.collapse}>
                        {this.$slots.sidebar && this.$slots.sidebar()}
                    </NCollapse>
                </NScrollbar>
            </NResizer>
        );
    },

    renderBody()
    {
        let contents = [
            this.ctor('renderHeader')(),
            this.ctor('renderContent')(),
        ];

        if ( this.relative ) {
            return (
                <div class="kyo-dataform__body">{contents}</div>
            );
        }

        return (
            <div class="kyo-dataform__body">
                <NScrollbar>{contents}</NScrollbar>
            </div>
        );
    },

    render()
    {


        return (
            <NForm form={this.KyoForm.value} errors={this.KyoForm.errors} class="kyo-dataform">
                {this.ctor('renderHead')()}
                {this.ctor('renderBody')()}
                {this.ctor('renderSidebar')()}
            </NForm>
        );
    }

}
