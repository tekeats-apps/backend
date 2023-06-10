<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBawJ5lMOjl3otByflPkAkWnyJFNnSbfQw&libraries=places">
</script>
<script>
    const autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'));

    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        const latitude = place.geometry.location.lat();
        const longitude = place.geometry.location.lng();

        $('#latitude').val(latitude);
        $('#longitude').val(longitude);

        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            var addressLongName = place.address_components[i].long_name;
            var addressShortName = place.address_components[i].short_name;

            if (addressType === 'administrative_area_level_2') {
                $('#city').val(addressLongName);
            }

            if (addressType === 'administrative_area_level_1') {
                $('#state').val(addressLongName);
            }

            if (addressType === 'country') {
                $('#country').val(addressLongName);
            }

            if (addressType === 'postal_code') {
                $('#zip_code').val(addressLongName);
            }
        }
    });
</script>
