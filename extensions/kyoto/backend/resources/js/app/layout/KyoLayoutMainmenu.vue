<template>
    <ul class="kyo-mainmenu">
        <li v-for="menu in menus" :key="menu.id" :class="getComponentClass(menu)">
            <router-link :to="menu.route">
                <span>{{ trans(menu.title) }}</span>
            </router-link>
            <n-popover type="tooltip" size="sm">
                {{ trans(menu.title) }}
            </n-popover>
        </li>
    </ul>
</template>
<script>
    export default {

        name: 'KyoLayoutMainmenu',

        computed: {

            menus() {
                return kyoto.getVisibleRoutes();
            }

        },

        methods: {

            getComponentClass(menu)
            {
                let classList = [
                    pi.Obj.get(menu, 'slug', 'undefined')
                ];

                if ( this.$route.path.indexOf(menu.route) !== -1 ) {
                    classList.push('is-loose-active');
                }

                return classList;
            }

        }

    }
</script>
