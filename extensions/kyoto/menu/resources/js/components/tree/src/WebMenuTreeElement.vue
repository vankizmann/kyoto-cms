<template>
    <div :class="classList" @dblclick="navigate">
        <span class="web-icon">
            <i :class="typeIcon"></i>
        </span>
        <span class="web-title">
            {{ value.title }}
        </span>
        <span class="web-count">
            {{ choice('No menus|:count menu|:count menus', childLength) }}
        </span>
        <span class="web-preview" v-if="previewLink">
            <a :class="icons.preview" :href="previewLink" target="_blank"></a>
        </span>
    </div>
</template>
<script>
    export default {

        name: 'WebMenuTreeElement',

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

            classList()
            {
                let classList = ['web-menu-tree-item'];

                if ( this.value.depth === 0 ) {
                    classList.push('web-menu-tree-item--root');
                }

                if ( this.value.state === -1 ) {
                    classList.push('web-menu-tree-item--deleted');
                }

                if ( this.value.state === 0 ) {
                    classList.push('web-menu-tree-item--disabled');
                }

                if ( this.value.state === 1 ) {
                    classList.push('web-menu-tree-item--enabled');
                }

                if ( this.value.state === 2 ) {
                    classList.push('web-menu-tree-item--archived');
                }

                if ( this.value.hide === 0 ) {
                    classList.push('web-menu-tree-item--visible');
                }

                if ( this.value.hide === 1 ) {
                    classList.push('web-menu-tree-item--hidden');
                }

                return classList;
            },

            isDomain()
            {
                return ! this.value.depth;
            },

            childLength()
            {
                return Math.abs(this.value.left -
                    this.value.right) - 1;
            },

            typeIcon()
            {
                return this.Obj.get(this.value,
                    'options.icon');
            },

            previewLink()
            {
                return this.Obj.get(this.value,
                    'options.preview');
            }

        },

        methods: {

            navigate()
            {
                let link = this.Obj.get(this.value, 'options.links.0.id');

                if ( this.Any.isEmpty(link) ) {
                    link = this.Obj.get(this.value, 'connector.connect.edit');
                }

                this.$router.push({ name: link, params: this.value });
            }

        }

    }
</script>
