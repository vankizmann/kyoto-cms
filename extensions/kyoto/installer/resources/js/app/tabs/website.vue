<template>
    <n-form>
        <n-form-item label="Title">
            <n-input placeholder="My Website"></n-input>
            <p class="info">
                The title of your website
            </p>
        </n-form-item>
        <n-form-item label="User">
            <n-input placeholder="admin"></n-input>
            <p class="info">
                The admin username (Needed for login)
            </p>
        </n-form-item>
        <n-form-item label="Password">
            <n-input native-type="password"></n-input>
            <p class="info">
                The admin password (Needed for login)
            </p>
        </n-form-item>
        <n-form-item label="E-Mail">
            <n-input placeholder="your@email.com"></n-input>
            <p class="info">
                Your E-Mail address to recover your admin user
            </p>
        </n-form-item>
    </n-form>
</template>
<script>
    export default {
        name: 'KyoTabsWebsite'
    }
</script>
