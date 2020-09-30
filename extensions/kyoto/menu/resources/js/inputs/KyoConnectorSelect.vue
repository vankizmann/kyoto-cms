<template>
    <NLoader :visible="load" size="small">
        <NSelect :key="UUID()" :value="value" @input="updateInput">
            <template v-for="item in items">
                <NSelectOption :value="item.value">{{ item.label }}</NSelectOption>
            </template>
        </NSelect>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoConnectorSelect',

        props: {

            value: {
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
                this.$emit('input', value);
            },

            loadConnectors()
            {
                if ( Nano.Data.has('kyo-connectors') ) {
                    return this.items = Nano.Data.get('kyo-connectors', []);
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
                Nano.Data.set('kyo-connectors', this.items = res.data);
            },

            fetchError()
            {
                Nano.Any.delay(this.loadConnectors, 1500);
            }

        }

    }
</script>
