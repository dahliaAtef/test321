var tripDatePicker = new datePicker({
    start:  document.getElementsByClassName('startDate'),
    end:    document.getElementsByClassName('endDate'),
    months: 1,
    test: '',
    
});


var populatedDatepicker = new datePicker({
    start:  document.getElementsByClassName('popStartDate'),
    end:    document.getElementsByClassName('popEndDate'),
    months: 2,
});

//alert(datePicker.today);