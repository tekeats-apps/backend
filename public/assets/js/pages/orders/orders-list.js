flatpickr("#start-date-field", {
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr, instance) {
        Livewire.emit('startDateChange', dateStr);
    }
});

flatpickr("#end-date-field", {
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr, instance) {
        Livewire.emit('endDateChange', dateStr);
    }
});
