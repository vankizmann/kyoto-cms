<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <div class="kyo-titlebar col--flex-0-0">
                <div class="grid grid--row grid--middle grid--30">

                    <div class="col--flex-0-0">
                        <h2>{{ Obj.get($route, 'meta.menu.title', 'Gates') }}</h2>
                    </div>

                    <div class="col--flex-0-1 col--left">
                        <NInput v-model="query.search" size="large" :placeholder="trans('Search')" icon="fa fa-search" :icon-disabled="true"></NInput>
                    </div>

                    <div class="col--flex-0-0 col--right">
                        <NButtonGroup v-show="selected.length">
                            <NButton type="secondary" :square="true" icon="fa fa-copy">
                                <!-- Copy icon -->
                            </NButton>
                            <NButton type="secondary" :square="true" icon="fa fa-trash">
                                <!-- Delete icon -->
                            </NButton>
                            <NConfirm type="danger" @confirm="deleteItems">
                                {{ trans('Are you sure you want to delete :count items?', { count: selected.length }) }}
                            </NConfirm>
                        </NButtonGroup>
                    </div>

                    <div class="col--flex-0-0">
                        <NButton type="primary" @click="$router.push({ name: 'KyoRoleEdit' })">
                            {{ trans('Add gate') }}
                        </NButton>
                    </div>
                </div>
            </div>

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
                :render-expand="true"
                :allow-drag="allowDrag"
                :allow-drop="allowDrop"
            >
                <NTableColumn type="string" prop="title" :label="trans('Title')" :fluid="true" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="string" prop="description" :label="trans('Description')" :fluid="true" :sort="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" :label="trans('Modified')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="datetime" prop="created_at" :label="trans('Created')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>
            </NTable>

            <NPaginator :total="result.total" :layout="['count', 'spacer']"></NPaginator>
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoGates',

        urls: {
            index: '/{locale}/kyoto/user/http/controllers/gate/index'
        },

        extends: window.KyoIndex
    }
</script>
