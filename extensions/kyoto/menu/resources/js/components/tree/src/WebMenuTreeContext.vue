<template>
    <NPopover ref="popover" type="select" trigger="context" position="bottom-start" :width="160">
        <template v-for="link in Obj.get(value, 'options.links')">
            <a class="n-popover-option" href="javascript:void(0)" @click="goto(link.id)">
                {{ link.text }}
            </a>
        </template>
        <a class="n-popover-option" href="javascript:void(0)" @click="goto()">
            {{ trans('Edit menu') }}
        </a>
    </NPopover>
</template>
<script>
    export default {

        name: 'WebMenuTreeContext',

        props: {

            value: {
                default()
                {
                    return {};
                },
                type: [Object]
            }

        },

        computed: {

        },

        methods: {

            goto(name = null)
            {
                if ( this.Any.isEmpty(name) ) {
                    name = this.Obj.get(this.value, 'connector.connect.edit')
                }

                let params = {
                    id: this.value.id
                };

                this.$router.push({ name, params },
                    () => this.$refs.popover.close());
            }

        }

    }
</script>
