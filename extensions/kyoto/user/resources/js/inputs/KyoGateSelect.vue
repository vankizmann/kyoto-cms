<template>
    <NLoader :visible="load" size="small">
        <NSelect :key="UUID()" :value="value" @input="updateInput">
            <template v-for="item in items">
                <NSelectOption :value="item.id">{{ item.title }}</NSelectOption>
            </template>
        </NSelect>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoGateSelect',

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
            this.loadGates();
        },

        methods: {

            updateInput(value)
            {
                this.$emit('input', value);
            },

            loadGates()
            {
                if ( Nano.Data.has('kyo-gates') ) {
                    return this.items = Nano.Data.get('kyo-gates', []);
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
                Nano.Data.set('kyo-gates', this.items = res.data);
            },

            fetchError()
            {
                Nano.Any.delay(this.loadGates, 1500);
            }

        }

    }
</script>
