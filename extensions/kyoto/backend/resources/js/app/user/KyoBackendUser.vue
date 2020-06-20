<template>
    <div>
        <span>
            Moin, {{ user.name }}
        </span>
        <NButton size="mini" type="secondary" icon="fa fa-ellipsis-v" :square="true">
            <!-- Icon -->
        </NButton>
        <NPopover trigger="click" position="bottom-end" :window="true">
            Heeey
        </NPopover>
    </div>
</template>
<script>
    export default {

        name: 'KyoBackendUser',

        computed: {

            user() {
                return window.backendUser;
            }

        }

    }
</script>
