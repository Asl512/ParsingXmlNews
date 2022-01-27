$(function() {

    /*$.fn.datepicker.language['en'] =  {
        days: ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'],
        daysShort: ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'],
        daysMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
        months: ['January','February','March','April','May','June','July','August','September','October','November','December'],
        monthsShort: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        today: 'Today',
        clear: 'Clear',
        dateFormat: 'yyyy/dd/mm',
        timeFormat: 'hh:ii',
        firstDay: 0
    };*/

    $('.startDate').datepicker({
        // multipleDates: 2,
        // multipleDatesSeparator: ' - ',
        // minDate: new Date(),
        language: 'ru',
        // dateFormat: 'yyyy-mm-dd',
        // firstDay: 0,
        /*toggleSelected: false,
        range: true,
        timepicker: true,
        minHours: 9,
        maxHours: 17,
        minutesStep: 5,*/
        // view: 'months',
        clearButton: true,
        onSelect(formattedDate, date, inst) {
            inst.hide();
            // alert(date);
        },
        altField: $('#alt'),
        altFieldDateFormat: 'yyyy-mm-dd'
        // position: 'bottom left'
    });

});