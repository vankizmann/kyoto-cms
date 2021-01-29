<template>
    <div class="kyo-userpanel">
        <a href="javascript:void(0)">
            Moin <strong>{{ user.name }}</strong>
        </a>
        <NPopover type="user" trigger="click" position="bottom-end" :width="300">
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

        name: 'KyoLayoutUser',

        computed: {

            user()
            {
                return kyoto.user;
            }

        }

    }
</script>
