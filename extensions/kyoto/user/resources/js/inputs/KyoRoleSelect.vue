<template>
    <NLoader :visible="load" size="small">
        <NSelect v-model="modelValue">
            <template v-for="item in items">
                <NSelectOption :value="item.id" :label="item.title" />
            </template>
        </NSelect>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoRoleSelect',

        props: {

            modelValue: {
                default()
                {
                    return null;
                }
            }

        },

        data()
        {
            return {
                load: false, items: []
            };
        },

        mounted()
        {
            this.loadRoles();
        },

        methods: {

            updateInput(value)
            {
                this.$emit('input', value);
            },

            loadRoles()
            {
                if ( Nano.Data.has('kyo-roles') ) {
                    return this.items = Nano.Data.get('kyo-roles', []);
                }

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                let route = this.Route.get('/{locale}/kyoto/user/http/controllers/role/total',
                    this.$root.$data);

                this.$http.get(route, options)
                    .then(this.fetchDone, this.fetchError);
            },

            fetchDone(res)
            {
                Nano.Data.set('kyo-roles', this.items = res.data);
            },

            fetchError()
            {
                Nano.Any.delay(this.loadRoles, 1500);
            }

        }

    }
</script>
