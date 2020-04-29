<template>
    <NLoader class="web-menu-tree" :visible="load">
        <div class="web-menu-tree__search">
            <NInput ref="input" v-model="search" :round="true" :placeholder="trans('Search')" :icon="icons.times" :icon-disabled="!search" @icon-click="clearSearch" />
        </div>
        <div class="web-menu-tree__list">
            <NDraggableTree :items="menus" :cascade.sync="cascade" use="WebMenuTreeElement" use-after="WebMenuTreeContext" @move="moveEntity" />
        </div>
    </NLoader>
</template>
<script>
    export default {

        name: 'WebMenuTree',

        data()
        {
            return { menus: [], cascade: [], search: '', load: true };
        },

        beforeMount()
        {
            this.Event.bind('updateMenu', this.fetchEntities, { _uid: this._uid });
            this.Event.bind('setLocale', this.fetchEntities, { _uid: this._uid });
        },

        beforeDestroy()
        {
            this.Event.unbind('updateMenu', { _uid: this._uid });
            this.Event.unbind('setLocale', { _uid: this._uid });
        },

        mounted()
        {
            this.$refs.input.$on('input', this.Any.debounce(
                this.fetchEntities, 500
            ));

            this.Event.fire('updateMenu');
        },

        methods: {

            clearSearch()
            {
                this.$refs.input.$emit('input', '');
            },

            fetchEntities()
            {
                let query = {
                    locale: this.$root.locale
                };

                if ( ! this.Any.isEmpty(this.search) ) {
                    query.search = this.search;
                }

                let route = this.Route.get('module.web-menu.menu.tree',
                    null, query);

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                this.$http.get(route, options)
                    .then(res => this.menus = res.data)
            },

            moveEntity(...args)
            {
                console.log(...args); this.fetchEntities();
            }

        }
    }
</script>
