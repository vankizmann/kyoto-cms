<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template slot="search">
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template slot="action">
                    <NButton type="primary" @click="$router.push({ name: 'KyoLanguageCreate' })">
                        {{ trans('Create language') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" @row-dblclick="gotoEdit">

                <NTableColumn type="string" prop="language" :label="trans('Language')" :fluid="true" :sort="true">
                    <router-link slot-scope="{ value }" :to="{ name: 'KyoLanguageEdit', params: value }">{{ value.language }}</router-link>
                </NTableColumn>

                <NTableColumn type="string" prop="country" :label="trans('Country')" :fluid="true" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="string" prop="locale" :label="trans('Locale')" :width="120" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>

                <NTableColumn type="string" prop="plate" :label="trans('Plate')" :width="120" :sort="true" :filter="true">
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

        name: 'KyoLanguages',

        localized: true,

        urls: {
            index: '/{locale}/kyoto/language/http/controllers/language/index',
            delete: '/{locale}/kyoto/language/http/controllers/language/delete'
        },

        defaults() {

            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['language', 'country']
            };

            return { query };
        },

        extends: window.KyoIndex
    }
</script>
