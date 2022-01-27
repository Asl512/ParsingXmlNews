<?php
    $datasumm = 0;
    if (isset($_POST['startDate']) && isset($_POST['term']) && isset($_POST['percent']) && isset($_POST['summa'])) 
    {
        $term = (int) $_POST['term'];
        if($_POST['select'] == '2')
        {
            $term *= 12;
        }
        $summa = (int)$_POST['summa'];
        $sumAdd = empty($_POST['replenishment']) ? 0 : (int)$_POST['replenishment'];
        $percent = (int)$_POST['percent'];
        $startDate = strtotime($_POST['startDate']);
        $endDate = strtotime("+$term MONTH", $startDate);
        $days = ($endDate - $startDate)/86400;
        $diff = empty($_POST['replenishment']) ? 0 : 1000;

        //определяет сколько дней в году
        $year = explode(".", $_POST['startDate'])[2];
        $daysY = 365;
        if (($year % 4 == 0 && $year % 100 != 0 || $year % 400 == 0))
        {
            $daysY = 366;
        }

        //формула
        $datasumm =($sumAdd * $term) + $summa + ($summa + $sumAdd * $term)  * $days * ($percent / $daysY/100) - $diff;
        echo json_encode(array('summa' => round($datasumm)));
    } 
?>