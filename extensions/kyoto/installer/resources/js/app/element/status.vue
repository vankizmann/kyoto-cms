<template>
    <div :class="classList">
        <span class="kyo-status__state">
            <!-- STATE -->
        </span>
        <div class="kyo-status__title">
            <slot></slot>
        </div>
        <div v-if="$slots.info" class="kyo-status__info">
            <slot name="info"></slot>
        </div>
    </div>
</template>
<script>
    export default {

        name: 'KyoElementStatus',

        props: {

            value: {
                default()
                {
                    return false;
                },
                type: [Boolean]
            }

        },

        computed: {

            classList()
            {
                return [
                    'kyo-status', this.veValue ? 'kyo-status--success' : 'kyo-status--danger'
                ]
            }

        },

        data()
        {
            return {
                veValue: this.value
            };
        },

        watch: {

            value()
            {
                if ( this.veValue !== this.value ) {
                    this.veValue = this.value;
                }
            }

        },

        methods: {

            setValue(value)
            {
                this.$emit('input', this.veValue = value);
            }

        }

    }
</script>
