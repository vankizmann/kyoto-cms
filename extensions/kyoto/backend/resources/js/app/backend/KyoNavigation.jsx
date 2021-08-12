import KyoNotify from "./KyoNotify";
import KyoMenu from "./KyoMenu";
import KyoDash from "./KyoDash";
import KyoLanguage from "./KyoLanguage";

export default {

    name: 'KyoNavigation',

    components: {
        [KyoNotify.name]: KyoNotify,
        [KyoMenu.name]: KyoMenu,
        [KyoDash.name]: KyoDash,
        [KyoLanguage.name]: KyoLanguage,
    },

    renderNotify()
    {
        return (<KyoNotify />);
    },

    renderMenu()
    {
        return (<KyoMenu />);
    },

    renderDash()
    {
        return (<KyoDash />);
    },

    renderLanguage()
    {
        return (<KyoLanguage />);
    },

    render()
    {
        return (
            <div class="kyo-navigation">
                { this.ctor('renderNotify')() }
                { this.ctor('renderMenu')() }
                { this.ctor('renderDash')() }
                { this.ctor('renderLanguage')() }
            </div>
        );
    }

}
