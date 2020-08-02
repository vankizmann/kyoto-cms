<template>
    <div class="kyo-titlebar">

        <div v-if="link" class="kyo-titlebar__back">
            <router-link :to="link">
                <i class="fa fa-arrow-left"></i> {{ trans('Back') }}
            </router-link>
        </div>

        <div class="kyo-titlebar__title">
            <slot name="title">
                <h2>{{ Obj.get($route, 'meta.menu.title') }}</h2>
            </slot>
        </div>

        <div v-if="search" class="kyo-titlebar__search">
            <slot name="search"></slot>
        </div>

        <div class="kyo-titlebar__spacer">
            <slot name="search"></slot>
        </div>

        <div v-if="action" class="kyo-titlebar__action">
            <slot name="action"></slot>
        </div>

    </div>
</template>
<script>
    export default {

        name: 'KyoTitlebar',

        props: {

            link: {
                default()
                {
                    return null;
                }
            },

            search: {
                default()
                {
                    return null;
                }
            }

        },

        computed: {

            action()
            {
                return !! this.$slots.action;
            }

        }

    }
</script>
