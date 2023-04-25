<script src="{{ URL::asset('assets/libs/filepond/filepond.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
</script>
<script
    src="{{ URL::asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
</script>
<script
    src="{{ URL::asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
</script>
<script src="{{ URL::asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

<script>
    // FilePond
    FilePond.registerPlugin(
        // encodes the file as base64 data
        FilePondPluginFileEncode,
        // validates the size of the file
        FilePondPluginFileValidateSize,
        // corrects mobile image orientation
        FilePondPluginImageExifOrientation,
        // previews dropped images
        FilePondPluginImagePreview
    );

    var inputMultipleElements = document.querySelectorAll('input.filepond-input-multiple');
    if (inputMultipleElements) {

        // loop over input elements
        Array.from(inputMultipleElements).forEach(function(inputElement) {
            // create a FilePond instance at the input element location
            FilePond.create(inputElement);
        })
    }
</script>
