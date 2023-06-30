<script src="{{ URL::asset('assets/libs/dropzone/dropzone.min.js') }}"></script>
<script>
    // Dropzone
    var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
    dropzonePreviewNode.id = "";
    if (dropzonePreviewNode) {
        var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
        dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
        var dropzone = new Dropzone(".dropzone", {
            url: 'https://httpbin.org/post',
            maxFiles: 1, // Limit to single file upload
            acceptedFiles: 'image/*', // Restrict file types if needed
            previewTemplate: previewTemplate,
            previewsContainer: "#dropzone-preview",
            init: function() {
                this.on("addedfile", function(file) {
                    if (this.files.length > 1) {
                        // Remove extra files if more than one file is added
                        this.removeFile(this.files[0]);
                    }
                });
            },
        });
    }
</script>
