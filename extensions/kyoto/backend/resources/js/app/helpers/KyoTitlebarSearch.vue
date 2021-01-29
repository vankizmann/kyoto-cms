<template>
    <div class="kyo-titlebar-search">
        <div class="kyo-titlebar-search__input">
            <NInput v-model="veValue" icon="fa fa-search" icon-position="before" :placeholder="trans('Search')" @keydown.enter="updateSearch" />
        </div>
        <div class="kyo-titlebar-search__clear">
            <NButton icon="fa fa-times" type="default" :square="true" :disabled="! this.veValue" @click="clearSearch" />
        </div>
    </div>
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
