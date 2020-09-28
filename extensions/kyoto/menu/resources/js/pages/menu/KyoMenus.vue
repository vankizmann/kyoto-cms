<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template slot="search">
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template slot="action">
                    <NButton type="primary" @click="$router.push({ name: 'KyoMenuCreate' })">
                        {{ trans('Create menu') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" :render-expand="true" @row-dblclick="gotoEdit">

                <NTableColumn type="string" prop="title" :label="trans('Title')" :fluid="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="string" prop="route" :label="trans('Route')" :fluid="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="datetime" prop="updated_at" :label="trans('Modified')" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="datetime" prop="created_at" :label="trans('Created')" :filter="true">
                    <!-- Column -->
                </NTableColumn>

            </KyoDatatable>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoMenus',

        localized: true,

        urls: {
            index: '/{locale}/kyoto/menu/http/controllers/menu/index',
            delete: '/{locale}/kyoto/menu/http/controllers/menu/delete'
        },

        defaults() {

            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
            };

            return { query };
        },

        extends: window.KyoIndex
    }
</script>
