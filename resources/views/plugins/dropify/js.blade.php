<script src="{{ URL::asset('assets/libs/dropify/dist/js/dropify.min.js') }}"></script>
<script>
    var drEvent = $('.dropify').dropify();

    function removeImage(recordId, tableField, tableName, imagePath) {
        $.ajax({
            type: 'POST',
            url: '{{ route('dropify.remove.image') }}', // Change this to the actual route
            dataType: 'json',
            data: {
                imagePath: imagePath,
                recordId: recordId,
                tableField: tableField,
                tableName: tableName, // Change the parameter name
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error response, if needed
            }
        });
    }
</script>
