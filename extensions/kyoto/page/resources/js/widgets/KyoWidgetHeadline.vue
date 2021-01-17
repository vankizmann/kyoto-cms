<template>
    <div>
        <NFormItem :label="trans('Title')">
            <NInput v-model="value.title"></NInput>
        </NFormItem>
    </div>
</template>
<script>
export default {

    name: 'KyoWidgetHeadline',

    inject: {
        NDraggableItem: {
            default: undefined
        }
    },

    computed: {

        value()
        {
            return this.NDraggableItem.veItem.value;
        }

    },

    mounted()
    {
        this.$watch('value', Nano.Any.debounce(this.NDraggableItem.export, 100), { deep: true });
    }

}
</script>
