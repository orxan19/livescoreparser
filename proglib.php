<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php

require "phpQuery-onefile.php";

function debug($arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

$context = stream_context_create(
    array(
        'http'=>array(
            'header' => 'Cookie:' . $_SERVER['HTTP_COOKIE'] . "\r\n". "user-agent: chrome" . "\r\n",
        )
    )
);

if (isset($_GET['page'])){
    $page = $_GET['page'];
} else{
    $page = 1;
}

$file = file_get_contents("https://tproger.ru/" . "page/" . $page, false, $context);

$pq = phpQuery::newDocument($file);


$articles = $pq->find('.entry-title-heading');
$articles_images = $pq->find('article .entry-image img');

foreach ($articles as $article){
    $all_articles[] = pq($article)->text();
    $all_link[] = pq($article)->parent()->attr('href');
}

foreach ($articles_images as $image => $value){
    if($image % 2 != 0){
        $all_articles_images[] = pq($value)->attr('src');
    }
}

$iteration_count = count($all_articles);

?>

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>№</td>
                    <td>Title</td>
                    <td>Picture</td>
                </tr>
                </thead>

                <tbody>
                <?php for($i = 0, $n = 1; $i < 10; $i++, $n++):?>

                    <tr>
                        <td><?php echo $n;?></td>
                        <td><a href="<?php echo $all_link[$i]?>"><?php echo $all_articles[$i]?></a></td>
                        <td><img src="<?php echo $all_articles_images[$i]; ?>" alt="" width="200px"></td>
                    </tr>
                <?php endfor;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <ul class="pagination">

                <?php if(isset($_GET['page'])){
                    $prev_page = $_GET['page'];
                } else{
                    $prev_page = 1;
                } ?>

                <?php if($prev_page > 1):?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'];?>?page=<?php echo --$_GET['page']; ?>" >Previous</a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                <?php endif;?>


                <?php for ($i = 1; $i <= 5; $i++):?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'];?>?page=<?php echo $i; ?>" ><?php echo $i; ?></a>
                    </li>
                <?php endfor;?>


                <?php if(isset($_GET['page'])){
                    $next_page = $_GET['page'];
                } else{
                    $next_page = 1;
                } ?>

                <?php if($next_page < 4):?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo $_SERVER['PHP_SELF'];?>?page=<?php echo ++$_GET['page']; ?>" >Next</a>
                    </li>
                <?php else:?>
                    <li class="page-item disabled">
                        <a class="page-link">Next</a>
                    </li>
                <?php endif;?>

            </ul>
        </div>
    </div>
</div>



</body>
</html>

