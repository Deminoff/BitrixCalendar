function init() {
    let elCalendar = document.getElementById('calendar');
    window.calendar = new FullCalendar.Calendar(elCalendar, {
        headerToolbar: {
            left: 'timeGridDay,timeGridWeek,dayGridMonth',
            center: 'title',
        },
        dateClick: function(info) {
            addRecord(info.date)
        }
    })

    window.calendar.render()

    let currentRange = getCurrentRange()

    getRecords(currentRange).then(res => {
        res.data.forEach(function(record) {
            window.calendar.addEvent(record)
        })
    })

    elCalendar.addEventListener("click", function(event){
        if(event.target.classList.contains("fc-button") || event.target.parentNode.classList.contains("fc-button")){
            window.calendar.removeAllEvents();
            getRecords(getCurrentRange()).then(res => {
                res.data.forEach(function(record) {
                    window.calendar.addEvent(record)
                })
            })
        }
    })
}

function getCurrentRange() {
    let allDates = document.querySelectorAll("[data-date]");

    return {
        startRange: allDates[0].dataset.date,
        endRange: allDates[allDates.length-1].dataset.date
    }
}

function getRecords(range) {
    return new Promise((resolve, reject) => {
        resolve(BX.ajax.runComponentAction('demirofl:calendar', 'getRecords', {
            mode:'ajax',
            data: {
                dateBegin: range.startRange,
                dateEnd: range.endRange
            }
        }))
    })
}

function addRecord(date) {
}

document.addEventListener('DOMContentLoaded', function() {
    init()
});
