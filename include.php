<?php
try {
    \Bitrix\Main\Loader::registerAutoLoadClasses(
        "demirofl.calendar",
        [
            "Demirofl\Calendar\General\CalendarGeneral" => "lib/classes/general/CalendarGeneral.php",
            "Demirofl\Calendar\Models\RecordTable" => "lib/models/RecordTable.php",
        ]
    );
} catch (\Bitrix\Main\LoaderException $e) {}
