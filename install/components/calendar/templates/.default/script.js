const getRecords = (filter) => {
    return new Promise((resolve, reject) => {
        resolve(BX.ajax.runAction("demirofl:calendar.api.ajax.getRecords", {
            data: {
                filter
            }
        }))
    })
}

const addRecord = (record) => {
    return new Promise((resolve, reject) => {
        resolve(BX.ajax.runAction("demirofl:calendar.api.ajax.addRecord", {
            data: {
                record
            }
        }))
    })
}

const pushRecords = async (filter) => {
    window.calendar.removeAllEvents()
    let events = await getRecords({
        ">=DATE_FROM": window.currentRange.startRange,
        "<=DATE_TO": window.currentRange.endRange
    })
    if (events.data.length > 0) {
        events.data.forEach(function (event) {
            window.calendar.addEvent({
                id: event.ID,
                start: getFormatedDate(event.DATE_FROM, "calendar"),
                end: getFormatedDate(event.DATE_TO, "calendar"),
                title: event.NAME,
                description: event.DESCRIPTION,
                status: event.STATUS
            })
        })
    }
}

function getFormatedDate(date, mode = "bitrix") {
    switch (mode) {
        case "bitrix":
            date = new Date(date)
            date = date.toLocaleDateString()
            break;
        case "calendar":
            date = new Date(date)
            break;
    }
    return date
}

function updateCurrentRange() {
    let allDates = document.querySelectorAll("#calendar [data-date]");

    window.currentRange = {
        startRange: getFormatedDate(allDates[0].dataset.date),
        endRange: getFormatedDate(allDates[allDates.length - 1].dataset.date)
    }
}


$(document).ready(async function () {
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
    elCalendar.addEventListener("click", function (event) {
        if (event.target.getAttribute("aria-pressed") == false &&(event.target.classList.contains("fc-button")
            || event.target.parentNode.classList.contains("fc-button"))) {
            updateCurrentRange()
            pushRecords()
        }
    })
    /* //Слушатель изменения представления календаря */
})


// addRecord({
//     "NAME": "Запись",
//     "DATE_FROM": "2022-02-14 12:00:00",
//     "DATE_TO": "2022-02-14 13:00:00",
//     "DESCRIPTION": "Это описание записи",
//     "STATUS": "пойду"
// })
