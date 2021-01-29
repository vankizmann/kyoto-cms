<template>
    <NLoader :visible="load" size="sm">
        <NSelect :model-value="modelValue" @update:modelValue="updateInput">
            <template v-for="item in items">
                <NSelectOption :value="item.value" :label="item.label" />
            </template>
        </NSelect>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoConnectorSelect',

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
            this.loadConnectors();
        },

        methods: {

            updateInput(value)
            {
                this.$emit('update:modelValue', value);
            },

            loadConnectors()
            {
                if ( pi.Data.has('kyo-connectors') ) {
                    return this.items = pi.Data.get('kyo-connectors', []);
                }

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                let route = this.Route.get('/{locale}/kyoto/package/http/controllers/package/connector',
                    this.$root.$data);

                this.$http.get(route, options)
                    .then(this.fetchDone, this.fetchError);
            },

            fetchDone(res)
            {
                pi.Data.set('kyo-connectors', this.items = res.data);
            },

            fetchError()
            {
                pi.Any.delay(this.loadConnectors, 1500);
            }

        }

    }
</script>
