<template>

</template>
<script>
    export default {

        name: 'KyoTitlebarSearch',

        props: {

            value: {
                default()
                {
                    return '';
                },
                type: [String]
            },

            debounce: {
                default()
                {
                    return 800;
                },
                type: [Number]
            }

        },

        data()
        {
            return {
                veValue: this.value
            }
        },

        mounted()
        {
            // this.$watch('veValue', pi.Any.debounce(this.updateSearch, this.debounce));
        },

        methods: {

            updateSearch()
            {
                this.$emit('update:modelValue', this.veValue);
            },

            clearSearch()
            {
                this.$emit('update:modelValue', this.veValue = '');
            }

        }

    }
</script>
