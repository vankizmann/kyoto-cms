<template>
    <div v-show="visible" class="kyo-uploads">
        <NFileList :items="filelist"></NFileList>
    </div>
</template>
<script>
    export default {

        name: 'KyoUploads',

        data()
        {
            return { visible: false, filelist: [] }
        },

        mounted()
        {
            this.Dom.find(document.body).on('drop',
                this.eventDrop);

            this.Dom.find(document.body).on('dragover',
                this.eventDragOver);
        },

        methods: {

            eventDragOver()
            {
                if ( ! event.dataTransfer.files ) {
                    return;
                }

                event.preventDefault();

                this.visible = true;
            },

            eventDrop()
            {
                if ( ! event.dataTransfer.files ) {
                    return;
                }

                event.preventDefault();

                this.Obj.each(event.dataTransfer.files, this.addFile);
            },

            addFile(file)
            {
                this.filelist.push({ id: this.UUID(), file: file });
            }

        },

    }
</script>
