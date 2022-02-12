const getRecords = (filter) => {
    return new Promise((resolve, reject) => {
        resolve(BX.ajax.runAction('demirofl:calendar.api.ajax.getRecords', {
            data: {
                filter
            }
        }))
    })
}

$(document).ready(async function() {

    /* Первичная инициализация календаря */
    let elCalendar = $("#calendar")[0]
    window.calendar = new FullCalendar.Calendar(elCalendar, {
        headerToolbar: {
            left: 'timeGridDay,timeGridWeek,dayGridMonth', center: 'title',
        },
    })
    window.calendar.render()
    updateCurrentRange()
    /* //Первичная инициализация календаря */

    /* Первичная инициализация записей */

    pushRecords()

    /* //Первичная инициализация записей */


    /* Слушатель изменения представления календаря */
    elCalendar.addEventListener("click", function(event) {
        if(event.target.classList.contains("fc-button")
            || event.target.parentNode.classList.contains("fc-button")){
            updateCurrentRange()
            pushRecords()
        }
    })
    /* //Слушатель изменения представления календаря */
})

function getFormatedDate(date) {
    date = new Date(date)
    return date.toLocaleDateString()
}

function updateCurrentRange() {
    let allDates = document.querySelectorAll("#calendar [data-date]");

    window.currentRange = {
        startRange: getFormatedDate(allDates[0].dataset.date), endRange: getFormatedDate(allDates[allDates.length - 1].dataset.date)
    }
}

async function pushRecords() {
    window.calendar.removeAllEvents()
    let events = await getRecords({">=DATE": window.currentRange.startRange, "<=DATE": window.currentRange.endRange})
    if(events.data.length > 0) {
        events.data.forEach(function(event) {
            window.calendar.addEvent({
                id: event.ID,
                start: event.DATE_FROM,
                end: event.DATE_TO,
                title: event.NAME,
                description: event.DESCRIPTION,
                status: event.STATUS
            })
        })
    }
}
