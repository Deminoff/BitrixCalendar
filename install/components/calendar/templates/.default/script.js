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

const updateRecord = (id, record) => {
    return new Promise((resolve, reject) => {
        resolve(BX.ajax.runAction("demirofl:calendar.api.ajax.updateRecord", {
            data: {
                id: id,
                record: record
            }
        }))
    })
}

const pushRecords = async (filter) => {
    window.calendar.removeAllEvents()
    let events = await getRecords({
        ">=DATE": window.currentRange.startRange,
        "<=DATE": window.currentRange.endRange
    })
    if (events.data.length > 0) {
        events.data.forEach(function (event) {
            window.calendar.addEvent({
                id: event.ID,
                //Вот здесь небольшой костыль, чтобы задача занимала 100% дня
                //Можно использовать allDay, но тогда отображается некрасиво
                start: getFormatedDate(event.DATE, "calendar").setHours(0),
                end: getFormatedDate(event.DATE, "calendar").setHours(24),
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

const initAddRecordModal = (info) => {
    let addRecordFormEl = $("#add-record_modal")
    addRecordFormEl.jqm().jqmShow()

    $("#add-record").on("click", function(event) {
        let name = $("#add-record_NAME")
        let date = getFormatedDate(info.date, "bitrix")
        let description = $("#add-record_DESCRIPTION")
        let status = $("#add-record_STATUS")
        event.preventDefault()
        addRecord({
            "NAME": name.val() ? name.val() : name.attr("placeholder"),
            "DATE": date,
            "DESCRIPTION": description.val() ? description.val() : description.attr("placeholder"),
            "STATUS": status.val()
        }).then(res => {
            pushRecords()
            addRecordFormEl.jqmHide()
            name.val("")
            description.val("")
            status.val("пойду")
            $("#add-record").off("click")
        })
    })
}

const initUpdateRecordModal = (info) => {
    let updateRecordFormEl = $("#update-record_modal")
    updateRecordFormEl.jqm().jqmShow()
    $("#update-record_NAME").val(info.event.title)
    $("#update-record_DESCRIPTION").val(info.event.extendedProps.description)
    $("#update-record_STATUS").val(info.event.extendedProps.status)
    $("#update-record").on("click", function(event) {
        let name = $("#update-record_NAME")
        let description = $("#update-record_DESCRIPTION")
        let status = $("#update-record_STATUS")
        event.preventDefault()
        updateRecord(info.event.id, {
            "NAME": name.val() ? name.val() : name.attr("placeholder"),
            "DESCRIPTION": description.val() ? description.val() : description.attr("placeholder"),
            "STATUS": status.val()
        }).then(res => {
            pushRecords()
            updateRecordFormEl.jqmHide()
            name.val("")
            description.val("")
            status.val("пойду")
            $("#update-record").off("click")
        })
    })
}

$(document).ready(async function () {
    /* Первичная инициализация календаря */
    let elCalendar = $("#calendar")[0]
    window.calendar = new FullCalendar.Calendar(elCalendar, {
        headerToolbar: {
            left: 'timeGridDay,timeGridWeek,dayGridMonth', center: 'title',
        },
        dateClick(info) {
            initAddRecordModal(info)
        },
        eventClick(info) {
            initUpdateRecordModal(info)
        }
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
