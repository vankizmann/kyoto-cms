<template>
    <div class="kyo-userpanel">
        <a href="javascript:void(0)">
            Moin <strong>{{ user.name }}</strong>
        </a>
        <NPopover type="userpanel" trigger="click" position="bottom-end" :window="true">
            <NTabs size="small">
                <NTabsItem label="Notifications" name="default">
                    Notifications
                </NTabsItem>
                <NTabsItem label="Settings" name="settings">
                    Settings
                </NTabsItem>
            </NTabs>
        </NPopover>
    </div>
</template>
<script>
    export default {

        name: 'KyoLayoutUserpanel',

        computed: {

            user()
            {
                return window.backendUser;
            }

        }

    }
</script>
