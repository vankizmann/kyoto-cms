<template>
    <NLoader :visible="load" class="web-menu-edit">

        <div class="web-body-item">
            <WebBackendTitle :info="trans('Last updated at :updated', { updated })" :goto="closeEntity">

                <div class="grid grid--row grid--10">

                    <div class="col--auto">
                        <NButton type="primary" :icon="icons.save" @click="updateEntity">
                            {{ trans('Apply') }}
                        </NButton>
                    </div>

                </div>

            </WebBackendTitle>
        </div>

        <div class="web-body-item">
            <NForm :errors="errors">

            <NFormItem prop="state" :label="trans('Status')">
                <NSelect v-model="entity.state">
                    <NSelectOption :value="1">{{ trans('Active') }}</NSelectOption>
                    <NSelectOption :value="0">{{ trans('Inactive') }}</NSelectOption>
                    <NSelectOption :value="2">{{ trans('Archived') }}</NSelectOption>
                </NSelect>
            </NFormItem>

            <NFormItem prop="hide" :label="trans('Visibility')">
                <NSelect v-model="entity.hide">
                    <NSelectOption :value="0">{{ trans('Visible') }}</NSelectOption>
                    <NSelectOption :value="1">{{ trans('Invisible') }}</NSelectOption>
                </NSelect>
            </NFormItem>

            <NFormItem prop="layout" :label="trans('Layout')">
                <NInput v-model="entity.layout" />
            </NFormItem>

            <NFormItem prop="icon" :label="trans('Icon')">
                <NInput v-model="entity.icon" />
            </NFormItem>

            <NFormItem prop="title" :label="trans('Title')">
                <NInput v-model="entity.title" />
            </NFormItem>

            <NFormItem prop="slug" :label="trans('Slug')">
                <NInput v-model="entity.slug" />
            </NFormItem>

            </NForm>
        </div>

    </NLoader>
</template>
<script>
    export default {

        name: 'WebMenuEdit',

        computed: {

            updated()
            {
                return this.Now.make(this.entity.updated_at || 'now')
                    .get().fromNow();
            }

        },

        data()
        {
            return { entity: {}, errors: {}, load: true };
        },

        mounted() {
            this.fetchEntity();
        },

        methods: {

            closeEntity()
            {
                this.$router.push({
                    name: this.findRoute('WebMenuIndex')
                });
            },

            doneEntity(res)
            {
                if ( ! this.Any.isEmpty(this.entity) ) {
                    this.Event.fire('updateMenu');
                }

                this.entity = this.Obj.get(res, 'data.data', {});
            },

            errorEntity(res)
            {
                this.errors = this.Obj.get(res, 'data.errors', {});
            },

            fetchEntity()
            {
                let route = this.Route.get('module.web-menu.menu.edit',
                    this.$route.params);

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                this.$http.get(route, options)
                    .then(this.doneEntity, this.errorEntity);
            },

            updateEntity()
            {
                this.Data.unset('web-menu-index');

                let route = this.Route.get('module.web-menu.menu.update',
                    this.$route.params);

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                this.$http.post(route, this.entity, options)
                    .then(this.doneEntity, this.errorEntity);
            }

        }
    }
</script>
