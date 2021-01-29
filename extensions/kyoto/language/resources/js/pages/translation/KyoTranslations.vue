<template>
    <NLoader :visible="load" class="grid grid--col">

        <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

            <template v-slot:search>
                <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
            </template>

            <template v-slot:action>
                <NButton type="primary" @click="$router.push({ name: 'KyoTranslationCreate' })">
                    {{ trans('Create translation') }}
                </NButton>
            </template>

        </KyoTitlebar>

        <KyoDatatable class="col--flex-1-1" @row-dblclick="gotoEdit">

            <template v-slot:default>
                <NTableColumn type="string" prop="source" :label="trans('Source')" :fluid="true" :sort="true" :filter="true">
                    <template v-slot:default="{ item }">
                        <router-link :to="{ name: 'KyoTranslationEdit', params: item }">{{ item.source }}</router-link>
                    </template>
                </NTableColumn>

                <NTableColumn type="string" prop="target" :label="trans('Target')" :fluid="true" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="string" prop="package" :label="trans('Package')" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" :label="trans('Modified')" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="created_at" :label="trans('Created')" :sort="true" :filter="true"></NTableColumn>
            </template>

            <template v-slot:info>
                <n-info-column type="string" prop="source" :label="trans('Source')"></n-info-column>
                <n-info-column type="string" prop="target" :label="trans('Target')"></n-info-column>
                <n-info-column type="string" prop="package" :label="trans('Package')"></n-info-column>
                <n-info-column type="datetime" prop="updated_at" :label="trans('Modified')"></n-info-column>
                <n-info-column type="datetime" prop="created_at" :label="trans('Created')"></n-info-column>
            </template>

        </KyoDatatable>

    </NLoader>
</template>
<script>
    export default {

        name: 'KyoTranslations',

        localized: true,

        urls: {
            index: '/{locale}/kyoto/language/http/controllers/translation/index',
            delete: '/{locale}/kyoto/language/http/controllers/translation/delete'
        },

        defaults() {

            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['source', 'target']
            };

            return { query };
        },

        extends: window.KyoIndex
    }
</script>
