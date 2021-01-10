document.addEventListener('DOMContentLoaded', function() {
    loadData();

    function loadData(){
        fetch('getData')
            .then(res => res.json())
            .then(res => {
                const values = [];
                res.forEach(x => {
                   values.push({title:'Titulo je',start:x.createdAt});
                });
                calendar(values);
            })
    }

    function calendar(values){
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: values,
            eventColor: '#378006',
            eventBackgroundColor: 'red'
        });
        calendar.render();
    }
});
