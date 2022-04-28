import { Obj, Any, Dom } from "@kizmann/pico-js";

export default {

    name: 'KyoHeader',

    inject: {

        KyoIndex: {
            default: undefined
        },

        KyoForm: {
            default: undefined
        }

    },

    props: {

        link: {
            default()
            {
                return false;
            }
        },

        back: {
            default()
            {
                return false;
            }
        },

        title: {
            default()
            {
                return null;
            }
        }

    },

    computed: {

        pagetitle()
        {
            return this.title || Obj.get(this.$route, 'meta.menu.title');
        },

    },

    data()
    {
        return {
            deleteView: false, copyView: false
        };
    },

    watch: {

        'title': function () {
            if ( ! Any.isEmpty(this.title) ) {
                Dom.title(this.trans(this.title));
            }
        }

    },

    renderSpacer()
    {
        return (
            <div class="kyo-header__spacer">
                { /* spacer */ }
            </div>
        );
    },

    renderAction()
    {
        if ( ! this.$slots.action ) {
            return null;
        }

        return (
            <div class="kyo-header__action">
                {this.$slots.action()}
            </div>
        );
    },

    renderSearch()
    {
        if ( ! this.$slots.search ) {
            return null;
        }

        return (
            <div class="kyo-header__search">
                {this.$slots.search()}
            </div>
        );
    },

    renderReturn()
    {
        if ( ! this.link && ! this.back ) {
            return null;
        }

        let nativeLink = () => (
            <a href="javascript:void(0)">
                <i class="fa fa-arrow-left" /> {this.trans('Back')}
            </a>
        );

        let routerLink = () => (
            <router-link to={this.link}>
                <i class="fa fa-arrow-left" /> {this.trans('Back')}
            </router-link>
        );

        return (
            <div class="kyo-header__back">
                {this.link ? routerLink() : nativeLink()}
            </div>
        );

    },

    renderTitle()
    {
        return (
            <div class="kyo-header__title">
                <h1>{ this.trans(this.pagetitle) }</h1>
            </div>
        );
    },

    render()
    {
        return (
            <div class="kyo-header">
                { this.ctor('renderReturn')() }
                { this.ctor('renderTitle')() }
                { this.ctor('renderSearch')() }
                { this.ctor('renderAction')() }
            </div>
        );
    }

}
