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

        name: 'KyoGateSelect',

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
            this.loadGates();
        },

        methods: {

            updateInput(value)
            {
                this.$emit('update:modelValue', value);
            },

            loadGates()
            {
                if ( pi.Data.has('kyo-gates') ) {
                    return this.items = pi.Data.get('kyo-gates', []);
                }

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                let route = this.Route.get('/{locale}/kyoto/user/http/controllers/gate/total',
                    this.$root.$data);

                this.$http.get(route, options)
                    .then(this.fetchDone, this.fetchError);
            },

            fetchDone(res)
            {
                pi.Data.set('kyo-gates', this.items = res.data);
            },

            fetchError()
            {
                pi.Any.delay(this.loadGates, 1500);
            }

        }

    }
</script>
