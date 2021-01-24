<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template v-slot:search>
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template v-slot:action>
                    <NButton type="primary" @click="$router.push({ name: 'KyoPageCreate' })">
                        {{ trans('Create page') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" @row-dblclick="gotoEdit" :group="['page', 'transaction']">

                <NTableColumn type="boolean" prop="state" :label="trans('State')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="boolean" prop="hide" :label="trans('Hide')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="string" prop="title" :label="trans('Title')" :fluid="true" :sort="true" :filter="true">
                    <template v-slot:default="{ item }">
                        <router-link :to="{ name: 'KyoPageEdit', params: item }">{{ item.title }}</router-link>
                    </template>
                </NTableColumn>

                <NTableColumn type="datetime" prop="updated_at" :label="trans('Modified')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="datetime" prop="created_at" :label="trans('Created')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

            </KyoDatatable>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPages',

        localized: true,

        urls: {
            index: '/{locale}/kyoto/page/http/controllers/page/index',
            delete: '/{locale}/kyoto/page/http/controllers/page/delete'
        },

        defaults() {

            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['title', 'content']
            };

            return { query };
        },

        extends: window.KyoIndex

    }
</script>
