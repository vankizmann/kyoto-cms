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
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad numquam recusandae, eius velit veniam quaerat! Harum dolorum ipsum cupiditate molestias, sunt numquam minus, qui pariatur officiis, deserunt dolor minima nesciunt quod nostrum inventore ipsam eum natus dignissimos. Quidem nulla blanditiis dolorum aliquid ratione corrupti vel, neque, mollitia numquam animi quam, expedita modi quaerat perferendis deleniti odio illum obcaecati amet eveniet. Ab eligendi impedit recusandae animi, iure facilis cumque suscipit sequi repellat similique quo fuga quibusdam error commodi nisi dolore nam?
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
