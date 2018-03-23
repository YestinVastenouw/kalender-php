<?php

    $previousMonth = null;
    $previousDay = null;

    foreach ($allData as $data) 
    {
        $date = DateTime::createFromFormat('!m', $data['month']);
        $currentMonth = $date->format('F');

        if ($previousMonth !== $currentMonth)
            echo("<h1> ". $currentMonth . "</h1>");

        if ($previousDay !== $data['day'])
            echo("<h2>". $data['day']. "</h2>");
        
        echo('<p><a href="'. URL. 'kalender/update/'. $data['id']. '">'. $data['person']. ' ('. $data['year'] .') </a><a href="'. URL. 'kalender/delete/'. $data['id'] . '">x</a></p>');

        $previousMonth = $currentMonth;
        $previousDay = $data['day'];
    }
?>
<p><a href="<?= URL?>kalender/create">+ Toevoegen</a></p>