<template>
    <div class="kyo-filterbar">
        <slot></slot>
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
