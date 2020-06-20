<template>
    <ul>
        <li v-for="menu in menus" :key="menu.id">
            <router-link :to="menu.route">{{ menu.title }}</router-link>
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

        }

    }
</script>
