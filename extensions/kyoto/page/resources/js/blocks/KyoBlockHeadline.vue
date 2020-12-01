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
        if ( ! Nano.Obj.has(clone, 'title') ) {
            Nano.Obj.set(clone, 'title', '');
        }

        this.NDraggableItem.update(this.value);

        // this.NDraggableItem.proto({
        //     title: 'foo2'
        // });
    }

}
</script>
