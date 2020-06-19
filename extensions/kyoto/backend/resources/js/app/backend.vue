<template>
    <div>
        <router-link to="/dashboard">dashboard</router-link>
        <router-link to="/pages">pages</router-link>
        <router-link to="/users">users</router-link>
        <router-link to="/languages">languages</router-link>
        <router-view />
    </div>
</template>
<script>
    export default {

        name: 'KyoBackend',
    }
</script>
