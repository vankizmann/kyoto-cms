<template>
    <NLoader :visible="false">

        <KyoTitlebar>
            <template slot="action">
                <NButton>{{ trans('Options') }}</NButton>
            </template>
        </KyoTitlebar>


        <div class="kyo-dashboard">
            <div class="grid grid--row grid--30-30">

                <div class="col--1-1">
                    <NChart :height="240" :point-offset="60"></NChart>
                </div>

            </div>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoDashboard',

    }
</script>
