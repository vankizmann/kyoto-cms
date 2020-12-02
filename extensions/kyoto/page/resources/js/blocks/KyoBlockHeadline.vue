<template>
    <div>
        <NFormItem>
            <NInput v-model="value.title"></NInput>
            <NButton>Update</NButton>
        </NFormItem>
    </div>
</template>
<script>
export default {

    name: 'KyoBlockHeadline',

    inject: {
        NDraggableItem: {
            default: undefined
        }
    },

    props: {

        value: {
            default()
            {
                return {};
            },
            type: [Object]
        }

    },

    beforeMount()
    {
        // this.NDraggableItem.proto({
        //     title: 'foo2'
        // });
    }

}
</script>
