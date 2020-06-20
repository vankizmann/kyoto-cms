<template>
    <div>
        <NSelect value="en">
            <NSelectOption value="en">Englisch</NSelectOption>
            <NSelectOption value="de">Deutsch</NSelectOption>
            <NSelectOption value="ru">Russisch</NSelectOption>
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

        }

    }
</script>
