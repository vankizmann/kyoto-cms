<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template v-slot:search>
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template v-slot:action>
                    <NButton type="primary" @click="$router.push({ name: 'KyoUserCreate' })">
                        {{ trans('Create user') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" @row-dblclick="gotoEdit">

                <NTableColumn type="string" prop="name" :label="trans('Name')" :fluid="true" :sort="true" :filter="true">
                    <template v-slot:default="{ item }">
                        <router-link :to="{ name: 'KyoUserEdit', params: item }">{{ item.name }}</router-link>
                    </template>
                </NTableColumn>

                <NTableColumn type="string" prop="email" :label="trans('E-Mail')" :fluid="true" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="updated_at" :label="trans('Modified')" :sort="true" :filter="true"></NTableColumn>
                <NTableColumn type="datetime" prop="created_at" :label="trans('Created')" :sort="true" :filter="true"></NTableColumn>

            </KyoDatatable>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoUsers',

        localized: false,

        urls: {
            index: '/{locale}/kyoto/user/http/controllers/user/index',
            delete: '/{locale}/kyoto/user/http/controllers/user/delete'
        },

        defaults() {

            let query = {
                page: 1, limit: 25, prop: 'updated_at', dir: 'asc', filter: [], search: '', columns: ['email', 'name']
            };

            return { query };
        },

        extends: window.KyoIndex
    }
</script>
