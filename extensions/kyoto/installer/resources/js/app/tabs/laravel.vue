<template>
    <n-form>
        <n-form-item label="Name">
            <n-input placeholder="kyoto" value="kyoto"></n-input>
            <p class="info">
                The name of your application
            </p>
        </n-form-item>
        <n-form-item label="Enviroment">
            <n-switch>Enable local mode</n-switch>
            <p class="info">
                Leave like this for production or if you dont know what this is
            </p>
        </n-form-item>
        <n-form-item label="Debug">
            <n-switch>Enable debug mode</n-switch>
            <p class="info">
                 Leave like this for production or if you dont know what this is
            </p>
        </n-form-item>
        <n-form-item label="URL">
            <n-input placeholder="https://localhost"></n-input>
            <p class="info">
                Leave like this for auto detection or paste your target url
            </p>
        </n-form-item>
        <n-form-item label="Key">
            <n-input></n-input>
            <p class="info">
                Leave if you dont know what this is
            </p>
        </n-form-item>
    </n-form>
</template>
<script>
    export default {
        name: 'KyoTabsLaravel'
    }
</script>
