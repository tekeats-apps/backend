/**
 * Show sweetalert popup when trigger event for delete
 * on livewire load for confirmation
 */
document.addEventListener('livewire:load', function() {
    Livewire.on('swal:confirm-delete', function(data) {
        Swal.fire({
            title: data.title,
            text: data.text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('delete', data.id);
            }
        });
    });
});

/**
 * generic toastr alert when dispacth event
 * from livewire component
 */
document.addEventListener('alert', ({
    detail
}) => {
    toastr.options = {
        "closeButton": true,
        "preventDuplicates": true,
        "progressBar": true
    }
    toastr[detail.type](detail.message)
});
