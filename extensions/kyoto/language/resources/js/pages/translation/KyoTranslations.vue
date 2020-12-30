<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template slot="search">
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template slot="action">
                    <NButton type="primary" @click="$router.push({ name: 'KyoTranslationCreate' })">
                        {{ trans('Create translation') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" @row-dblclick="gotoEdit">

                <NTableColumn type="string" prop="source" :label="trans('Source')" :fluid="true" :sort="true" :filter="true">
                    <router-link slot-scope="{ value }" :to="{ name: 'KyoTranslationEdit', params: value }">{{ value.source }}</router-link>
                </NTableColumn>

                <NTableColumn type="string" prop="target" :label="trans('Target')" :fluid="true" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="string" prop="package" :label="trans('Package')" :sort="true" :filter="true">
                    <!-- Column -->
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
