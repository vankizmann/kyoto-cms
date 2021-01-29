<template>
    <div class="kyo-layout-language">
        <NSelect :model-value="$root.locale" @update:modelValue="changeLocale">
            <NSelectOption v-for="lang in languages" :key="lang.id" :value="lang.locale" :label="lang.language"/>
        </NSelect>
    </div>
</template>
<script>
import { Arr, Locale } from "@kizmann/pico-js";

export default {

    name: 'KyoLayoutLanguage',

    computed: {

        languages() {
            return kyoto.languages;
        }

    },

    mounted()
    {
        this.addDashes();
    },

    methods: {

        changeLocale(locale)
        {
            pi.Event.fire('locale:change', locale);
        },

        addDashes()
        {
            Arr.each(this.languages, (lang) => {
                kyoto.addDash({
                    type: 'locale',
                    title: lang.language,
                    description: Locale.trans('Change current language to :language', lang),
                    callback: () => this.changeLocale(lang.locale)
                });
            });
        }

    }

}
</script>
