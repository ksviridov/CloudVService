<?php
$jsonFile = file_get_contents('./input1.json');

$decodedJson = json_decode($jsonFile, true); // Массив с всей информацией, о проделанной функции

$moderLabels = $decodedJson["Labels"]; // Для хранения массива лейблов

foreach ($moderLabels as $label)
{
    if($label["Label"]["Name"] == "Dog")
    {
        echo "Обнаружена собака на " .
            $label["Timestamp"] .
            " " .
            "с уверенностью: " .
            $label["Label"]["Confidence"] .
            " " .
            "процентов" .
            "<br>";
    }
}
//var_dump($decodedJson);