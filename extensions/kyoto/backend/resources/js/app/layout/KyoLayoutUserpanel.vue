<template>
    <div>
        <span>
            Moin, {{ user.name }}
        </span>
        <NButton size="mini" type="secondary" icon="fa fa-ellipsis-v" :square="true">
            <!-- Icon -->
        </NButton>
        <NPopover type="custom" trigger="click" position="bottom-end" :window="true">
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

            user() {
                return window.backendUser;
            }

        },

        mounted()
        {
            this.Notify('Hello');
        }

    }
</script>
