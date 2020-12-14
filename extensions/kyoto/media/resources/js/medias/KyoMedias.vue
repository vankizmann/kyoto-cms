<template>
    <NLoader :visible="load" class="full-height-child">

        <div class="grid grid--col">

            <KyoTitlebar class="col--flex-0-0">
                <template slot="action">
                    <NButton type="primary" @click="$router.push({ name: 'KyoPageCreate' })">
                        {{ trans('Add folder') }}
                    </NButton>
                </template>
            </KyoTitlebar>

            <NDraggrid class="col--flex-1-1" :items="result.data">
                <template slot-scope="{ value }" :render-select="true">
                    {{ value.title }}
                </template>
            </NDraggrid>
        </div>

        <KyoUploads></KyoUploads>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoMedias',

        urls: {
            index: '/{locale}/kyoto/page/http/controllers/page/index'
        },

        data()
        {
            return { filelist: [] }
        },

        mounted()
        {

        },

        methods: {

            addFile(file)
            {
                this.filelist.push({ id: this.UUID(), file: file });
            }

        },

        extends: window.KyoIndex
    }
</script>
