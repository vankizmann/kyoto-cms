<template>
    <NScrollbar class="kyo-dashboard">

        <KyoHeader>
            <template v-slot:action>
                <NButton size="lg">{{ trans('Options') }}</NButton>
            </template>
        </KyoHeader>


        <div class="grid grid--row grid--30-30">

            <div class="col--1-1">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad numquam recusandae, eius velit veniam quaerat! Harum dolorum ipsum cupiditate molestias, sunt numquam minus, qui pariatur officiis, deserunt dolor minima nesciunt quod nostrum inventore ipsam eum natus dignissimos. Quidem nulla blanditiis dolorum aliquid ratione corrupti vel, neque, mollitia numquam animi quam, expedita modi quaerat perferendis deleniti odio illum obcaecati amet eveniet. Ab eligendi impedit recusandae animi, iure facilis cumque suscipit sequi repellat similique quo fuga quibusdam error commodi nisi dolore nam?
            </div>

        </div>
    </NScrollbar>
</template>
<script>
    export default {

        name: 'KyoDashboard',

        beforeMount()
        {
            this.$root.hideWebsite();
        },

        beforeUnmount()
        {
            this.$root.showWebsite();
        },

    }
</script>
