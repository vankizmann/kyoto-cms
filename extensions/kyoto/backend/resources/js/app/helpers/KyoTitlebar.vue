<template>
    <div class="kyo-titlebar">

        <div v-if="link" class="kyo-titlebar__back">
            <router-link :to="link">
                <i class="fa fa-arrow-left"></i> {{ trans('Back') }}
            </router-link>
        </div>

        <div v-if="back" class="kyo-titlebar__back">
            <a href="javascript:void(0)" @click.stop="$router.go(-1)">
                <i class="fa fa-arrow-left"></i> {{ trans('Back') }}
            </a>
        </div>

        <div class="kyo-titlebar__title">
            <slot name="title">
                <h1>{{ Any.isEmpty(title) ? trans(this.menuTitle) : trans(title) }}</h1>
            </slot>
        </div>

        <div v-if="search" class="kyo-titlebar__search">
            <slot name="search"></slot>
        </div>

        <div class="kyo-titlebar__spacer">
            <!-- SPACER -->
        </div>

        <div v-if="KyoForm" class="kyo-titlebar__description">

            <NButton :link="true" icon-position="after" icon="fa fa-angle-down">
                {{ Any.isEmpty(updated) ? trans('Not saved yet') : updated }}
            </NButton>

            <NPopover trigger="click" :width="220">
                <NPopoverGroup>
                    {{ trans('Actions') }}
                </NPopoverGroup>
                <NPopoverOption v-if="copyEvent" type="info" icon="fa fa-copy" @click="copyView = true">
                    {{ trans('Copy item') }}
                </NPopoverOption>
                <NPopoverOption v-if="deleteEvent" type="danger" icon="fa fa-times" @click="deleteView = true">
                    {{ trans('Delete item') }}
                </NPopoverOption>
                <NPopoverOption v-if="! copyEvent && ! deleteEvent" :disabled="true">
                    {{ trans('No actions available') }}
                </NPopoverOption>
            </NPopover>

        </div>

        <div v-if="KyoIndex" class="kyo-titlebar__description">

            <NButton :link="true" icon-position="after" icon="fa fa-angle-down">
                {{ choice('No item selected|One item selected|:count items selected', selected) }}
            </NButton>

            <NPopover trigger="click" :width="220">
                <NPopoverGroup>
                    {{ trans('Actions') }}
                </NPopoverGroup>
                <NPopoverOption v-if="copyEvent" type="info" icon="fa fa-copy" :disabled="! selected" @click="copyView = !! selected">
                    {{ trans('Copy selection') }}
                </NPopoverOption>
                <NPopoverOption v-if="deleteEvent" type="danger" icon="fa fa-times" :disabled="! selected" @click="deleteView = !! selected">
                    {{ trans('Delete selection') }}
                </NPopoverOption>
                <div v-if="! copyEvent && ! deleteEvent" :disabled="true">
                    {{ trans('No actions available') }}
                </div>
            </NPopover>

        </div>

        <div v-if="action" class="kyo-titlebar__action">
            <slot name="action"></slot>
        </div>

        <NConfirm v-if="KyoForm" v-model="copyView" :listen="false" type="warning" @confirm="confirmCopy">
            {{ choice('Do you really want to copy this item?') }}
        </NConfirm>

        <NConfirm v-if="KyoForm" v-model="deleteView" :listen="false" type="danger" @confirm="confirmDelete">
            {{ choice('Do you really want to delete this item?') }}
        </NConfirm>

        <NConfirm v-if="KyoIndex" v-model="copyView" :listen="false" type="warning" @confirm="confirmCopy">
            {{ choice('Do you really want to copy :count items?', selected) }}
        </NConfirm>

        <NConfirm v-if="KyoIndex" v-model="deleteView" :listen="false" type="danger" @confirm="confirmDelete">
            {{ choice('Do you really want to delete :count items?', selected) }}
        </NConfirm>

    </div>
</template>
<script>
    export default {

        name: 'KyoTitlebar',

        inject: {

            KyoIndex: {
                default: undefined
            },

            KyoForm: {
                default: undefined
            }

        },

        props: {

            link: {
                default()
                {
                    return false;
                }
            },

            back: {
                default()
                {
                    return false;
                }
            },

            title: {
                default()
                {
                    return null;
                }
            }

        },

        computed: {

            menuTitle()
            {
                return pi.Obj.get(this.$route, 'meta.menu.title');
            },

            search()
            {
                return !! this.$slots.search;
            },

            action()
            {
                return !! this.$slots.action;
            },

            copyEvent()
            {
                return !! this.$attrs.onCopy;
            },

            deleteEvent()
            {
                return !! this.$attrs.onDelete;
            },

            selected()
            {
                return ! this.KyoIndex ? 0 : this.KyoIndex.selected.length;
            },

            updated()
            {
                return ! this.KyoForm ? 0 : this.Now.make(this.KyoForm.result.updated_at)
                    .format(this.trans('YYYY-MM-DD HH:mm'));
            }

        },

        data()
        {
            return {
                deleteView: false, copyView: false
            };
        },

        watch: {

            'title': function () {
                if ( ! pi.Any.isEmpty(this.title) ) {
                    pi.Dom.title(this.trans(this.title));
                }
            }

        },

        methods: {

            confirmCopy()
            {
                this.$emit('copy');
            },

            confirmDelete()
            {
                this.$emit('delete');
            }

        }

    }
</script>
