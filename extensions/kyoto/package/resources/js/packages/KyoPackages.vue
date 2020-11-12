<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template slot="search">
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template slot="action">
                    <NButton type="primary" @click="$router.push({ name: 'KyoPackageCreate' })">
                        {{ trans('Create package') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" @row-dblclick="gotoEdit">
                <NTableColumn type="boolean" prop="state" :label="trans('State')" :sort="true" :filter="true">
                    <!-- Column -->
                </NTableColumn>
                <NTableColumn type="string" prop="name" :label="trans('Name')" :fluid="true" :sort="true">
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

        name: 'KyoPackages',

        urls: {
            index: '/{locale}/kyoto/package/http/controllers/package/index'
        },

        extends: window.KyoIndex
    }
</script>
