import KyoNotify from "./KyoNotify";
import KyoMenu from "./KyoMenu";
import KyoDash from "./KyoDash";

export default {

    name: 'KyoNavigation',

    components: {
        [KyoNotify.name]: KyoNotify,
        [KyoMenu.name]: KyoMenu,
        [KyoDash.name]: KyoDash,
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

    render()
    {
        return (
            <div class="kyo-navigation">
                { this.ctor('renderNotify')() }
                { this.ctor('renderMenu')() }
                { this.ctor('renderDash')() }
            </div>
        );
    }

}
