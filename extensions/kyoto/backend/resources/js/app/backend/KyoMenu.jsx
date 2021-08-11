import { Arr, Any } from "@kizmann/pico-js";

export default {

    name: 'KyoMenu',

    renderItem(item)
    {
        let classList = [];

        if ( this.$route.path.indexOf(item.route) !== - 1 ) {
            classList.push('is-loose-active');
        }

        return (
            <li class={classList}>
                <router-link to={item.route}>
                    {this.trans(item.title)}
                </router-link>
                {this.ctor('renderPopover')(item)}
            </li>
        );
    },

    renderSubitem(item)
    {
        let classList = [];

        if ( this.$route.path.indexOf(item.route) !== - 1 ) {
            classList.push('is-loose-active');
        }

        return (
            <li class={classList}>
                <router-link to={item.route}>
                    {this.trans(item.title)}
                </router-link>
            </li>
        );
    },

    renderPopover(item)
    {
        if ( Any.isEmpty(item.children) ) {
            return null;
        }

        let popoverProps = {
            type: 'light',
            width: 200,
            position: 'bottom-start',
        };

        return (
            <n-popover {...popoverProps}>
                <ul class="kyo-menu__list">
                    {Arr.each(item.children, this.ctor('renderSubitem'))}
                </ul>
            </n-popover>
        )
    },

    render()
    {
        return (
            <ul class="kyo-menu">
                {Arr.each(kyoto.getVisibleRoutes(), this.ctor('renderItem'))}
            </ul>
        );
    }

}
