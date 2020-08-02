<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0">
                <template slot="action">
                    <NButton type="primary" @click="$router.push({ name: 'KyoPageCreate' })">
                        {{ trans('Add page') }}
                    </NButton>
                    <NButton type="secondary" :disabled="! selected.length">
                        {{ trans('Delete') }}
                    </NButton>
                    <NConfirm type="danger" @confirm="deleteItems">
                        {{ trans('Are you sure you want to delete :count items?', { count: selected.length }) }}
                    </NConfirm>
                </template>
            </KyoTitlebar>

            <NTable
                class="kyo-table col--flex-1-1"
                :items="result.data"
                :viewport-height="true"
                :expanded.sync="expanded"
                :selected.sync="selected"
                :filter-props.sync="query.filter"
                :sort-prop.sync="query.prop"
                :sort-dir.sync="query.dir"
                :item-height="44"
                :allow-drag="allowDrag"
                :allow-drop="allowDrop"
                @row-dblclick="gotoEdit"
            >
                <NTableColumn type="string" prop="title" label="Title" :fluid="true" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" label="Modified" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="created_at" label="Created" :filter="true"></NTableColumn>
            </NTable>

            <NPaginator :page.sync="query.page" :limit.sync="query.limit" :total="result.total"></NPaginator>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPages',

        urls: {
            index: '/{locale}/kyoto/page/http/controllers/page/index'
        },

        extends: window.KyoIndex
    }
</script>
