<template>
    <div class="kyo-localepanel">
        <NSelect :model-value="$root.locale" @update:modelValue="changeLocale">
            <NSelectOption v-for="lang in languages" :key="lang.id" :value="lang.locale" :label="lang.language"/>
        </NSelect>
    </div>
</template>
<script>
    export default {

        name: 'KyoLayoutLanguage',

        computed: {

            languages() {
                return window.backendLanguages;
            }

        },

        methods: {

            changeLocale(locale)
            {
                Nano.Event.fire('locale:change', locale);
            }

        }

    }
</script>
