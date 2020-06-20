<template>
    <div>
        <div class="kyo-mainmenu">
            <KyoLayoutMainmenu></KyoLayoutMainmenu>
        </div>
        <div class="kyo-submenu">
            <KyoLayoutSubmenu></KyoLayoutSubmenu>
        </div>

        <router-view />
    </div>
</template>
<script>
    import KyoLayoutMainmenu from "./layout/KyoLayoutMainmenu";
    import KyoLayoutSubmenu from "./layout/KyoLayoutSubmenu";

    export default {

        name: 'KyoBackend',

        components: {
            KyoLayoutMainmenu, KyoLayoutSubmenu
        }

    }
</script>
