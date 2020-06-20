<template>
    <div class="kyo-dashboard">
        <div class="kyo-titlebar">
            <div class="grid grid--row">

                <div class="col--flex-0-0 col--left">
                    <h2>Dashboard</h2>
                </div>

                <div class="col--flex-0-0 col--right">
                    <NButton type="secondary" icon="fa fa-cog">Configure</NButton>
                </div>
            </div>
        </div>
        <div class="n-inverse">
            <NChart :height="240" :point-offset="60"></NChart>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'KyoDashboard'
    }
</script>
