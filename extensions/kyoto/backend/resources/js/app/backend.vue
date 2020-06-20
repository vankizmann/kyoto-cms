<template>
    <div>
        <div class="kyo-header">
            <div class="kyo-header__top">

                <div class="grid grid--row grid--20">
                    <KyoLayoutMainmenu class="kyo-mainmenu col--flex-0-0 col--left">
                        <!-- Mainmenu -->
                    </KyoLayoutMainmenu>

                    <KyoBackendUser class="kyo-backenduser col--flex-0-0 col--right">
                        <!-- Backenduser -->
                    </KyoBackendUser>
                </div>

            </div>
            <div class="kyo-header__bot col--flex-0-0">

                <div class="grid grid--row grid--20">
                    <KyoLayoutSubmenu class="kyo-submenu col--flex-0-0">
                        <!-- Submenu -->
                    </KyoLayoutSubmenu>
                </div>

            </div>
        </div>

        <router-view />
    </div>
</template>
<script>
    import KyoLayoutMainmenu from "./layout/KyoLayoutMainmenu";
    import KyoLayoutSubmenu from "./layout/KyoLayoutSubmenu";
    import KyoBackendUser from "./user/KyoBackendUser";

    export default {

        name: 'KyoBackend',

        components: {
            KyoLayoutMainmenu, KyoLayoutSubmenu, KyoBackendUser
        }

    }
</script>
