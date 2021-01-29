<template>
    <ul class="kyo-submenu">
        <li v-for="menu in menus" :key="menu.id">
            <router-link :to="menu.route">{{ trans(menu.title) }}</router-link>
        </li>
    </ul>
</template>
<script>
    export default {

        name: 'KyoLayoutSubmenu',

        computed: {

            menus() {

                let menus = pi.Obj.get(this.$route,
                    'meta.root.children', []);

                return kyoto.getVisibleRoutes(menus);
            }

        }

    }
</script>
