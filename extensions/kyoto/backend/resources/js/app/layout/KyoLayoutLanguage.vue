<template>
    <div class="kyo-localepanel">
        <NSelect :value="$root.locale" @input="changeLocale">
            <NSelectOption v-for="lang in languages" :key="lang.id" :value="lang.locale">{{ lang.language }}</NSelectOption>
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
                this.$root.$emit('locale:change', locale);
            }

        }

    }
</script>
