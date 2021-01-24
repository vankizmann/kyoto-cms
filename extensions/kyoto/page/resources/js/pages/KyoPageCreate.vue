<template>
    <NLoader :visible="load" class="full-height-child">
        <div class="grid grid--col">

            <KyoTitlebar :link="{ name: 'KyoPages' }" class="col--flex-0-0">
                <template v-slot:action>
                    <NButtonGroup>
                        <NButton type="primary" @click="storeItem">
                            {{ trans('Apply') }}
                        </NButton>
                        <NButton type="primary" @click="storeItemClose">
                            {{ trans('Save') }}
                        </NButton>
                    </NButtonGroup>
                </template>
            </KyoTitlebar>

            <KyoPageWidgets class="col--flex-1-0" v-model="result.builder">

                <NForm :form="result" :errors="errors">

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

                    </NFormGroup>

                </NForm>

            </KyoPageWidgets>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPageCreate',

        localized: false,

        urls: {
            show: '/{locale}/kyoto/page/http/controllers/page/show',
            store: '/{locale}/kyoto/page/http/controllers/page/store'
        },

        beforeMount()
        {
            this.$root.hideWebsite();
        },

        beforeDestroy()
        {
            this.$root.showWebsite();
        },

        methods: {

            gotoEdit(row)
            {
                this.$router.push({
                    name: 'KyoPageEdit', params: row.data
                });

                console.log(row.data);
            },

            gotoIndex()
            {
                this.$router.push({
                    name: 'KyoPages'
                });
            }

        },

        extends: window.KyoForm

    }
</script>
