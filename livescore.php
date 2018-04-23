<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
<?php
require 'phpQuery-onefile.php';

function debug($arr){
    echo '<pre>' . print_r($arr, true) . '</pre>';
}


$context = stream_context_create(
    array(
        'http'=>array(
            'header' => 'Cookie:' . $_SERVER['HTTP_COOKIE'] . "\r\n". "user-agent: chrome" . "\r\n",
        )
    )
);


$file = file_get_contents("http://www.livescores.com", false, $context);

$pq = phpQuery::newDocument($file);
$teams  = $pq->find('.ply');
$dates  = $pq->find('.min');
$scores = $pq->find('.sco');

foreach ($teams as $team){
    $all_teams[] = pq($team)->html();

}

foreach ($dates as $date){
    $all_dates[] = pq($date)->html();

}

foreach ($scores as $score){
    $all_scores[] = pq($score)->text();
    $all_iteration[] = pq($score)->text();

}




foreach($all_teams as $team => $value){
    if($team % 2 == 0){
        $all_home_teams[] = $value;
    }else{
        $all_away_teams[] = $value;
    }
}

$iteration_count = count($all_dates);
?>
<div class="container">
<div class="row">
    <div class="col-md-10">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>№</td>
                <td>Time</td>
                <td>Home team</td>
                <td>Score</td>
                <td>Away team</td>
            </tr>
            </thead>
            <tbody>

            <?php for($i = 0, $n = 1; $i < $iteration_count; $i++, $n++):?>

                <tr>
                    <td><?php echo $n;?></td>
                    <td><?php echo $all_dates[$i]?></td>
                    <td><?php echo $all_home_teams[$i]?></td>
                    <td><?php echo $all_scores[$i]?></td>
                    <td><?php echo $all_away_teams[$i]?></td>
                </tr>
            <?php endfor;?>


            </tbody>
        </table>
    </div>
</div>
</div>

</body>
</html>

