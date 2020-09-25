<template>
    <NLoader :visible="load">
        <NTransfer :key="UUID()" :value="value" :items="items" label-prop="title" :source-label="trans('Available')" :target-label="trans('Active')" @input="updateInput">
            <!-- TRANSFER -->
        </NTransfer>
    </NLoader>
</template>
<script>
    export default {

        name: 'KyoPolicyTransfer',

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
            this.loadPolicies();
        },

        methods: {

            updateInput(value)
            {
                this.$emit('input', value);
            },

            loadPolicies()
            {
                if ( Nano.Data.has('kyo-policies') ) {
                    return this.items = Nano.Data.get('kyo-policies', []);
                }

                let options = {
                    onLoad: () => this.load = true,
                    onDone: () => this.load = false
                };

                let route = this.Route.get('/{locale}/kyoto/user/http/controllers/policy/total',
                    this.$root.$data);

                this.$http.get(route, options)
                    .then(this.fetchDone, this.fetchError);
            },

            fetchDone(res)
            {
                Nano.Data.set('kyo-policies', this.items = res.data);
            },

            fetchError()
            {
                Nano.Any.delay(this.loadPolicies, 1500);
            }

        }

    }
</script>
