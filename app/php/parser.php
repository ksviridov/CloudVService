<?php
$jsonFile = file_get_contents('./input.json');

$decodedJson = json_decode($jsonFile, true); // Массив с всей информацией, о проделанной функции

$moderLabels = $decodedJson["ModerationLabels"]; // Для хранения массива лейблов

foreach ($moderLabels as $label)
{
    if(($label["ModerationLabel"]["Confidence"] >= 90) and ($label["ModerationLabel"]["ParentName"] != ""))
    {
        echo "Таймстамп: " .
            $label["Timestamp"] .
            " " .
            "Уверенность: " .
            $label["ModerationLabel"]["Confidence"] .
            " " .
            "Причина: " .
            $label["ModerationLabel"]["Name"] .
            "<br>";
    }
}

//var_dump($decodedJson);