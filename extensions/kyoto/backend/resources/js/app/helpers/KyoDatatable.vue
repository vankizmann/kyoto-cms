<template>
    <div class="kyo-datatable">

        <NTable :items="KyoIndex.result.data" :viewport-height="true" :disable-move="true" :remove-node="false" :insert-node="false" :selected.sync="KyoIndex.selected" :expanded.sync="KyoIndex.expanded" :filter-props.sync="KyoIndex.query.filter" :sort-prop.sync="KyoIndex.query.prop" :sort-dir.sync="KyoIndex.query.dir" :item-height="40" :loading-init="0" :allow-drag="KyoIndex.allowDrag" :allow-drop="KyoIndex.allowDrop" :safe-zone="KyoIndex.safeZone" :render-expand="renderExpand" @move="KyoIndex.onMove" @row-dblclick="rowDblclick">
            <slot></slot>
        </NTable>

        <NPaginator :page.sync="KyoIndex.query.page" :limit.sync="KyoIndex.query.limit" :total="KyoIndex.result.total" :layout="renderPagination ? ['limit', 'count', 'spacer', 'goto', 'pages'] : ['count']"></NPaginator>

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
                    return ! this.renderExpand;
                },
                type: [Boolean]
            },

        },

        methods: {

            rowDblclick(...args)
            {
                this.$emit('row-dblclick', ...args);
            }

        }

    }
</script>
