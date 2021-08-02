<template>
    <div class="kyo-datatable">
        <div class="kyo-datatable__body">
            <NTable ref="table" :items="KyoIndex.result.data" :disable-move="true" v-model:current="KyoIndex.current" v-model:selected="KyoIndex.selected" v-model:expanded="KyoIndex.expanded" v-model:filter="KyoIndex.query.filter" v-model:sort-prop="KyoIndex.query.prop" v-model:sort-dir="KyoIndex.query.dir" :item-height="40" :loading-init="0" :allow-drag="KyoIndex.allowDrag" :allow-drop="KyoIndex.allowDrop" :safezone="KyoIndex.safezone" :handle="handle" :render-handle="renderHandle" :render-expand="renderExpand" :group="group" :allow-groups="allowGroups" @move="KyoIndex.onMove" :threshold="501" @row-dblclick="rowDblclick">
                <slot name="default"></slot>
            </NTable>

            <NPaginator v-model:page="KyoIndex.query.page" v-model:limit="KyoIndex.query.limit" :total="KyoIndex.result.total" :layout="renderPagination ? ['limit', 'count', 'spacer', 'goto', 'pages'] : ['count']"></NPaginator>
        </div>

        <NResizer class="kyo-datatable__side" :width="320" position="left" @update:modelValue="setWidth">
            <NScrollbar class="">
                <div>
                    <NInfo v-show="KyoIndex.current" ref="info" :item="KyoIndex.current">
                        <slot name="info"></slot>
                    </NInfo>
                </div>
            </NScrollbar>
        </NResizer>

    </div>
</template>
<script>
    export default {

        name: 'KyoDatatable',

        inject: {

            KyoIndex: {
                default: undefined
            }

        },

        props: {

            group: {
                default()
                {
                    return ['default'];
                },
                type: [Array]
            },

            allowGroups: {
                default()
                {
                    return ['default'];
                },
                type: [Array]
            },

            handle: {
                default()
                {
                    return false;
                },
                type: [Boolean]
            },

            renderHandle: {
                default()
                {
                    return false;
                },
                type: [Boolean]
            },

            renderExpand: {
                default()
                {
                    return false;
                },
                type: [Boolean]
            },

            renderPagination: {
                default()
                {
                    return true;
                },
                type: [Boolean]
            },

        },

        methods: {

            setWidth(width)
            {
                pi.Event.fire('datatable:resize', width);

                pi.Dom.find(window).fire('resize')
            },

            rowDblclick(...args)
            {
                console.log('dblclick')
                this.$emit('row-dblclick', ...args);
            }

        }

    }
</script>
