<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0" @delete="deleteItems">

                <template slot="search">
                    <KyoTitlebarSearch v-model="query.search"></KyoTitlebarSearch>
                </template>

                <template slot="action">
                    <NButton type="primary" @click="$router.push({ name: 'KyoGateCreate' })">
                        {{ trans('Create gate') }}
                    </NButton>
                </template>

            </KyoTitlebar>

            <KyoDatatable class="col--flex-1-1" :render-expand="true">

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

            </KyoDatatable>

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
