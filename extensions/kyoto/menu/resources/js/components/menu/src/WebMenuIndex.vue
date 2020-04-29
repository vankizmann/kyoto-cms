<template>
    <NLoader :visible="load" class="web-menu-index full-height-child">
        <div class="grid grid--col">

            <div class="web-body-item col--flex-none">
                <WebBackendTitle :info="trans('An overview of all menu items registered in your webpage')">

                    <div class="grid grid--row grid--10">

                        <div class="col--auto">
                            <NButton type="primary" :icon="icons.create" @click="">
                                {{ trans('Create') }}
                            </NButton>
                        </div>

                        <div class="col--auto">
                            <NButton type="secondary" :square="true" :icon="icons.action" :disabled="! selected.length">
                                <!-- Icon -->
                            </NButton>
                            <NPopover ref="popover" type="select" trigger="click" position="bottom-end" :width="220" :disabled="! selected.length">

                                <NButton class="n-popover-option" type="primary" :link="true" :icon="icons.activate">
                                    {{ trans('Activate') }}
                                </NButton>
                                <NConfirm type="primary" @confirm="modifyEntities('activate')">
                                    {{ choice('Do you want to activate :count items?', selected.length) }}
                                </NConfirm>

                                <NButton class="n-popover-option" type="warning" :link="true" :icon="icons.deactivate">
                                    {{ trans('Deactivate') }}
                                </NButton>
                                <NConfirm type="warning" @confirm="modifyEntities('deactivate')">
                                    {{ choice('Do you want to deactivate :count items?', selected.length) }}
                                </NConfirm>

                                <NButton class="n-popover-option" type="info" :link="true" :icon="icons.archive">
                                    {{ trans('Archive') }}
                                </NButton>
                                <NConfirm type="info" @confirm="modifyEntities('archive')">
                                    {{ choice('Do you want to archive :count items?', selected.length) }}
                                </NConfirm>

                                <NButton class="n-popover-option" type="danger" :link="true" :icon="icons.delete">
                                    {{ trans('Delete') }}
                                </NButton>
                                <NConfirm type="danger" @confirm="modifyEntities('delete')">
                                    {{ choice('Do you want to delete :count items?', selected.length) }}
                                </NConfirm>

                            </NPopover>
                        </div>


                    </div>

                </WebBackendTitle>
            </div>

            <div class="web-body-item col--flex-fixed">
                <NTable ref="table" unique-prop="id" :selected-keys.sync="selected" v-model="entities" :sort-prop="sort.prop" :sort-dir="sort.dir" :filter-props="Obj.values(filter)" :adapt-height="true" @sort="setSorting" @row-dblclick="navigate">

                    <NTableColumn type="selection" :fixed-width="45" align="center" :label="trans('Selection')">
                        <!-- ID -->
                    </NTableColumn>

                    <NTableColumn prop="state" type="option" options-label="$value.label" options-value="$value.value" :options="states" :sort="true" :filter="true" :label="trans('State')" :default-width="75">
                        <!-- State -->
                    </NTableColumn>

                    <NTableColumn prop="hide" type="option" options-label="$value.label" options-value="$value.value" :options="hides" :sort="true" :filter="true" :label="trans('Visibility')" :default-width="75">
                        <!-- Hide -->
                    </NTableColumn>

                    <NTableColumn prop="title" :sort="true" :filter="true" :label="trans('Title')" :default-width="200">
                        <!-- Title -->
                    </NTableColumn>

                    <NTableColumn prop="slug" :sort="true" :filter="true" :label="trans('Slug')" :default-width="200">
                        <!-- Slug -->
                    </NTableColumn>

                    <NTableColumn prop="updated_at" type="datetime" :sort="true" :filter="true" :label="trans('Updated')" :default-width="100">
                        <!-- Updated at -->
                    </NTableColumn>

                    <NTableColumn prop="created_at" type="datetime" :sort="true" :filter="true" :label="trans('Created')" :default-width="100">
                        <!-- Created -->
                    </NTableColumn>

                </NTable>
            </div>

            <div class="web-body-item col--flex--none">
                <NPaginator :page.sync="paginate.page" :limit.sync="paginate.limit" :total="paginate.total" @paginate="fetchEntities" :limit-options="[50, 100, 500]" />
            </div>

        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'WebMenuIndex',

        data()
        {
            let paginate = {
                page: 1, total: 0, limit: 50
            };

            let filter = [
                // Default filters
            ];

            let sort = {
                prop: 'updated_at', dir: 'desc'
            };

            let data = {
                paginate, sort, filter
            };

            let stored = this.Cookie.get(this.ctor('name'));

            if ( stored ) {
                this.Obj.assign(data, this.Str.objectify(stored));
            }

            let states = [
                { value: '1', label: this.trans('Active') },
                { value: '0', label: this.trans('Inactive') },
                { value: '2', label: this.trans('Archived') },
            ];

            let hides = [
                { value: '1', label: this.trans('Visible') },
                { value: '0', label: this.trans('Invisible') },
            ];

            return { ...data, states, hides, entities: [], selected: [], load: true };
        },

        beforeMount()
        {
            this.Event.bind('setLocale', this.fetchEntities, { _uid: this._uid });
        },

        beforeDestroy()
        {
            this.Event.unbind('setLocale', { _uid: this._uid });
        },

        mounted()
        {
            this.$refs.table.$on('filter',
                this.Any.debounce(this.setFiltering, 500));

            if ( this.ctor('preload', false) && this.Data.has(this.ctor('name')) ) {
                return this.Any.delay(this.preloadEntities, 250);
            }

            this.fetchEntities();
        },

        watch: {

            entities()
            {
                this.Data.set(this.ctor('name'), this.entities);
            },

            paginate()
            {
                let data = this.Obj.only(this, [
                    'paginate', 'sort', 'filter'
                ]);

                this.Cookie.set(this.ctor('name'),
                    this.Str.stringify(data));
            },

            sort()
            {
                let data = this.Obj.only(this, [
                    'paginate', 'sort', 'filter'
                ]);

                this.Cookie.set(this.ctor('name'),
                    this.Str.stringify(data));
            },

            filter()
            {
                let data = this.Obj.only(this, [
                    'paginate', 'sort', 'filter'
                ]);

                this.Cookie.set(this.ctor('name'),
                    this.Str.stringify(data));
            }

        },

        methods: {

            navigate({ row })
            {
                let name = this.findRoute('WebMenuEdit');

                this.$router.push({ name, params: row });
            },

            setSorting(prop, dir)
            {
                this.$set(this, 'sort', { prop, dir });

                this.fetchEntities();
            },

            setFiltering(filter)
            {
                this.$set(this, 'filter', this.Arr.filter(filter,
                    val => ! this.Any.isEmpty(val.value)));

                this.Any.debounce(() => this.fetchEntities(), 500)();
            },

            doneEntities(res)
            {
                let request = this.Obj.get(res, 'data', []);

                this.paginate = {
                    page: request.page, total: request.total, limit: request.limit
                };

                this.entities = this.Obj.get(res, 'data.data', []);
            },

            errorEntities(res)
            {
                this.errors = this.Obj.get(res, 'data.errors', {});
            },

            preloadEntities()
            {
                this.entities = this.Data.get(this.ctor('name'));

                this.load = false;
            },

            fetchEntities()
            {
                this.selected = [];

                let query = this.Obj.only(this.paginate, [
                    'page', 'limit'
                ]);

                this.Obj.assign(query, this.sort, {
                    filter: this.filter, locale: this.$root.locale
                });

                let route = this.Route.get('module.web-menu.menu.index',
                    this.$route.params, query);

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                this.$http.get(route, options)
                    .then(this.doneEntities).catch(this.errorEntities);
            },

            modifyEntities(type)
            {
                this.$refs.popover.close();

                let query = {
                    ids: this.selected
                };

                let route = this.Route.get(`module.web-menu.menu.${type}`,
                    this.$route.params);

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                this.$http.post(route, query, options)
                    .then(this.fetchEntities).catch(this.errorEntities);
            }

        }

    }
</script>
