<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id='calendar'></div>


<div class="jqmWindow" id="add-record_modal">
    <div class="jqmClose">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 320 512">
            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/>
        </svg>
    </div>
    <form action="">
        <div class="form-header">
            Создать запись
        </div>
        <div class="form-group">
            <label for="add-record_NAME">Название</label>
            <input type="text" placeholder="Новая задача" data-add-id="NAME" id="add-record_NAME"></input>
        </div>
        <div class="form-group">
            <label for="add-record_DESCRIPTION">Описание</label>
            <textarea placeholder="Описание задачи" data-add-id="DESCRIPTION" id="add-record_DESCRIPTION"></textarea>
        </div>
        <div class="form-group">
            <label for="add-record_STATUS">Статус</label>
            <select data-add-id="STATUS" id="add-record_STATUS">
                <option>пойду</option>
                <option>не пойду</option>
                <option>под вопросом</option>
            </select>
        </div>

        <div class="form-group">
            <button id="add-record">Создать</button>
        </div>
    </form>
</div>

<div class="jqmWindow" id="update-record_modal">
    <div class="jqmClose">
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 320 512">
            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"/>
        </svg>
    </div>
    <form action="">
        <div class="form-header">
            Изменить запись
        </div>
        <div class="form-group">
            <label for="update-record_NAME">Название</label>
            <input type="text" placeholder="Новая задача" data-add-id="NAME" id="update-record_NAME"></input>
        </div>
        <div class="form-group">
            <label for="update-record_DESCRIPTION">Описание</label>
            <textarea placeholder="Описание задачи" data-add-id="DESCRIPTION" id="update-record_DESCRIPTION"></textarea>
        </div>
        <div class="form-group">
            <label for="update-record_STATUS">Статус</label>
            <select data-add-id="STATUS" id="update-record_STATUS">
                <option>пойду</option>
                <option>не пойду</option>
                <option>под вопросом</option>
            </select>
        </div>

        <div class="form-group">
            <button id="update-record">Изменить</button>
        </div>
    </form>
</div>
