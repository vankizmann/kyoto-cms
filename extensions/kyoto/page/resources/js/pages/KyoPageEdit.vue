<template>
    <NLoader :visible="load" class="grid grid--col">

        <KyoTitlebar :link="{ name: 'KyoPages' }" class="col--flex-0-0" @delete="deleteItem">
            <template v-slot:action>
                <NButtonGroup>
                    <NButton type="primary" @click="updateItem">
                        {{ trans('Apply') }}
                    </NButton>
                    <NButton type="primary" @click="updateCloseItem">
                        {{ trans('Save') }}
                    </NButton>
                </NButtonGroup>
            </template>
        </KyoTitlebar>

        <KyoPageWidgets class="col--flex-1-1" v-model="result.widgets">

            <NForm :form="result" :errors="errors">

                <NFormGroup icon="fa fa-compass" :label="trans('Menu')">

                    <NFormItem :label="trans('Title')" prop="title">
                        <NInput v-model="result.title"></NInput>
                    </NFormItem>

                    <NFormItem :label="trans('Slug')" prop="slug">
                        <NInput v-model="result.slug"></NInput>
                    </NFormItem>

                    <NFormItem :label="trans('Content')" prop="content">
                        <NTextarea v-model="result.content"></NTextarea>
                    </NFormItem>

                    <NFormItem :label="trans('Images')" prop="images">
                        <KyoMediaSelect v-model="result.images" :limit="3"></KyoMediaSelect>
                    </NFormItem>

                </NFormGroup>

                <NFormGroup icon="fa fa-cog" :label="trans('Settings')">

                    <NFormItem :label="trans('State')" prop="state">
                        <NSwitch v-model="result.state" :on-value="1" :off-value="0">
                            {{ trans('Item is enabled') }}
                        </NSwitch>
                    </NFormItem>

                    <NFormItem :label="trans('Hide')" prop="hide">
                        <NSwitch v-model="result.hide" :on-value="1" :off-value="0">
                            {{ trans('Item is hidden') }}
                        </NSwitch>
                    </NFormItem>

                </NFormGroup>

            </NForm>

        </KyoPageWidgets>

    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPageEdit',

        localized: true,
        refresh: true,

        urls: {
            show: '/{locale}/kyoto/page/http/controllers/page/show',
            update: '/{locale}/kyoto/page/http/controllers/page/update',
            delete: '/{locale}/kyoto/page/http/controllers/page/delete'
        },

        beforeMount()
        {
            this.$root.hideWebsite();
        },

        beforeUnmount()
        {
            this.$root.showWebsite();
        },

        methods: {

            gotoIndex()
            {
                this.$router.push({ name: 'KyoPages' });
            }

        },

        extends: window.KyoForm

    }
</script>
