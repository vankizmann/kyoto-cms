<template>
    <ul>
        <li v-for="menu in menus" :key="menu.id">
            <router-link :to="menu.route">{{ menu.title }}</router-link>
        </li>
    </ul>
</template>
<script>
    export default {

        name: 'KyoLayoutSubmenu',

        computed: {

            menus() {
                console.log(this.$route);
                return Nano.Arr.filter(this.$route.meta.root.children, (menu) => {
                    return ! menu.hide;
                });
            }

        }

    }
</script>
