<template>
    <div class="kyo-titlebar-search">
        <div class="kyo-titlebar-search__input">
            <NInput v-model="veValue" icon="fa fa-search" icon-position="before" :placeholder="trans('Search')" />
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
            this.$watch('veValue', Nano.Any.debounce(this.updateSearch, this.debounce));
        },

        methods: {

            updateSearch()
            {
                this.$emit('input', this.veValue);
            },

            clearSearch()
            {
                this.$emit('input', this.veValue = '');
            }

        }

    }
</script>
