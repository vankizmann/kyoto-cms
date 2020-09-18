<template>
    <ul class="kyo-mainmenu">
        <li v-for="menu in menus" :key="menu.id" :class="getComponentClass(menu)">
            <router-link :to="menu.route">
                <span>{{ menu.title }}</span>
            </router-link>
        </li>
    </ul>
</template>
<script>
    export default {

        name: 'KyoLayoutMainmenu',

        computed: {

            menus() {
                return Nano.Arr.filter(window.backendRoutes, (menu) => {
                    return ! menu.hide;
                });
            }

        },

        methods: {

            getComponentClass(menu)
            {
                return Nano.Obj.get(menu, 'slug', 'undefined');
            }

        }

    }
</script>
