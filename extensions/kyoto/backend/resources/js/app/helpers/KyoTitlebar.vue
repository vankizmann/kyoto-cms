<template>
    <div class="kyo-titlebar">

        <div v-if="link" class="kyo-titlebar__back">
            <router-link :to="link">
                <i class="fa fa-arrow-left"></i> {{ trans('Back') }}
            </router-link>
        </div>

        <div class="kyo-titlebar__title">
            <slot name="title">
                <h1>{{ trans(Obj.get($route, 'meta.menu.title')) }}</h1>
            </slot>
        </div>

        <div v-if="search" class="kyo-titlebar__search">
            <slot name="search"></slot>
        </div>

        <div class="kyo-titlebar__spacer">
            <!-- SPACER -->
        </div>

        <div v-if="KyoForm" class="kyo-titlebar__description">

            <NButton :link="true" :square="true" icon="fa fa-angle-down">
                {{ Any.isEmpty(updated) ? trans('Not saved yet') : trans('Saved at :updated', { updated }) }}
            </NButton>

            <NPopover type="dropdown" trigger="click" position="bottom-end" :window="true" :width="220">
                <div class="n-popover-label">
                    {{ trans('Actions') }}
                </div>
                <NButton v-if="copyEvent" class="n-popover-option" type="primary" :link="true" :disabled="! selected" @click="copyView = true">
                    {{ trans('Copy item') }}
                </NButton>
                <div v-if="! copyEvent" class="n-popover-option n-disabled">
                    {{ trans('No actions available') }}
                </div>
            </NPopover>

        </div>

        <div v-if="KyoForm && deleteEvent" class="kyo-titlebar__delete">
            <NButton type="danger" @click="deleteView = true">
                {{ trans('Delete item') }}
            </NButton>
        </div>

        <div v-if="KyoIndex" class="kyo-titlebar__description">

            <NButton :link="true" type="default" icon="fa fa-angle-down">
                {{ choice('No item selected|One item selected|:count items selected', selected) }}
            </NButton>

            <NPopover type="dropdown" trigger="click" position="bottom-end" :window="true" :width="220">
                <div class="n-popover-label">
                    {{ trans('Actions') }}
                </div>
                <NButton v-if="copyEvent" class="n-popover-option" type="warning" :link="true" :disabled="! selected" @click="copyView = true">
                    {{ trans('Copy selection') }}
                </NButton>
                <NButton v-if="deleteEvent" class="n-popover-option" type="danger" :link="true" :disabled="! selected" @click="deleteView = true">
                    {{ trans('Delete selection') }}
                </NButton>
                <div v-if="! copyEvent && ! deleteEvent" class="n-popover-option n-disabled">
                    {{ trans('No actions available') }}
                </div>
            </NPopover>

        </div>

        <div v-if="action" class="kyo-titlebar__action">
            <slot name="action"></slot>
        </div>

        <NConfirm v-if="KyoForm" v-model="copyView" :selector="false" type="warning" @confirm="confirmCopy">
            {{ choice('Do you really want to copy this item?') }}
        </NConfirm>

        <NConfirm v-if="KyoForm" v-model="deleteView" :selector="false" type="danger" @confirm="confirmDelete">
            {{ choice('Do you really want to delete this item?') }}
        </NConfirm>

        <NConfirm v-if="KyoIndex" v-model="copyView" :selector="false" type="warning" @confirm="confirmCopy">
            {{ choice('Do you really want to copy :count items?', selected) }}
        </NConfirm>

        <NConfirm v-if="KyoIndex" v-model="deleteView" :selector="false" type="danger" @confirm="confirmDelete">
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
                    return null;
                }
            }

        },

        computed: {

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
                return !! this.$listeners.copy;
            },

            deleteEvent()
            {
                return !! this.$listeners.delete;
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
