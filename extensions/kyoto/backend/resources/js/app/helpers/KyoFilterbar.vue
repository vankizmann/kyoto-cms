<template>
    <div class="kyo-filterbar">
        <div class="kyo-filterbar__inner">
            <slot></slot>
        </div>
    </div>
</template>
<script>
    export default {

        name: 'KyoFilterbar',

        inject: {

            KyoIndex: {
                default: undefined
            },

            KyoForm: {
                default: undefined
            }

        }

    }
</script>
