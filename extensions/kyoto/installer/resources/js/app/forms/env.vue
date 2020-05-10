<template>
    <n-tabs>
        <n-tabs-item name="default" :label="trans('Laravel')" :keep-alive="true" :preload="true">
            <kyo-tabs-laravel></kyo-tabs-laravel>
        </n-tabs-item>
        <n-tabs-item name="database" :label="trans('Database')" :keep-alive="true" :preload="true">
            <kyo-tabs-database></kyo-tabs-database>
        </n-tabs-item>
        <n-tabs-item name="website" :label="trans('Website')" :keep-alive="true" :preload="true">
            <kyo-tabs-website></kyo-tabs-website>
        </n-tabs-item>
    </n-tabs>
</template>
<script>
    export default {
        name: 'KyoFormsEnv'
    }
</script>
