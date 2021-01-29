<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template v-slot:search>
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template v-slot:action>
                    <NButton type="primary" @click="$router.push({ name: 'KyoMenuCreate' })">
                        {{ trans('Create menu') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" :render-expand="true" @row-dblclick="gotoEdit">

                <NTableColumn type="string" prop="title" :label="trans('Title')" :fluid="true" :filter="true">
                    <template v-slot:default="{ item }">
                        <router-link :to="{ name: 'KyoMenuEdit', params: item }">{{ item.title }}</router-link>
                    </template>
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
            delete: '/{locale}/kyoto/menu/http/controllers/menu/delete',
            move: '/{locale}/kyoto/menu/http/controllers/menu/move'
        },

        defaults() {

            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title']
            };

            return { query };
        },

        methods: {

            allowDrag()
            {
                return true;
            },

            allowDrop()
            {
                return true;
            },

            safeZone(height)
            {
                return height * 0.26;
            }

        },

        extends: window.KyoIndex
    }
</script>
