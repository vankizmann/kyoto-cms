<template>
    <div class="kyo-backend">
        <div class="kyo-header">
            <div class="grid grid--row grid--20">

                <KyoLayoutSubmenu class="kyo-submenu col--flex-0-0 col--left">
                    <!-- Submenu -->
                </KyoLayoutSubmenu>

                <KyoBackendUser class="kyo-backenduser col--flex-0-0 col--right">
                    <!-- Backenduser -->
                </KyoBackendUser>

            </div>
        </div>

        <div class="kyo-body full-height-child">
            <router-view />
        </div>

        <div class="kyo-sidebar">
            <KyoLayoutMainmenu class="kyo-mainmenu">
                <!-- Mainmenu -->
            </KyoLayoutMainmenu>
            <KyoLayoutLanguage class="kyo-backend__language">
                <!-- Language -->
            </KyoLayoutLanguage>
        </div>

    </div>
</template>
<script>
    export default {

        name: 'KyoBackend',

    }
</script>
