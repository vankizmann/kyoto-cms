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

            eventDragOver(event)
            {
                if ( ! event.dataTransfer.files.length ) {
                    return;
                }

                event.preventDefault();

                this.visible = true;
            },

            eventDrop(event)
            {
                if ( ! event.dataTransfer.files.length ) {
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
