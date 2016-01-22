<?php
require 'vendor/autoload.php';

// http://www.ymc.ch/en/webscraping-in-php-with-guzzle-http-and-symfony-domcrawler
// http://zrashwani.com/simple-web-spider-php-goutte/#.Vp-SYlPyuV4
// https://github.com/codeguy/arachnid

if (!isset($_GET['host'])) {
    exit('no host selected');
}

$maxDepth = isset($_GET['maxdepth']) ? $_GET['maxdepth'] : 3;
$isForced = isset($_GET['force']) ? ($_GET['force'] == '1') : false;
$host = $_GET['host'];
$protocol = 'http://';
$target = $protocol.$host.'/';
$hostFile = $host.'.json';

// setup and writing
$links = array();
if ($isForced || !is_file($hostFile)) {
    // Initiate crawl
    $crawler = new \Arachnid\Crawler($target, $maxDepth);
    $crawler->traverse();

    // Get link data
    $links = $crawler->getLinks();
    file_put_contents($hostFile, json_encode($links));
} else {
    $links = json_decode(file_get_contents($hostFile), true);
}

$table = new \Html\Table();
$table->setData($links);
$table
    ->add('#', 'rowcount')
    ->add('title')
    ->add('status_code')
    ->add('h1_count')
    ->add('frequency')
    ->add('links_text', 'arrayCount')
    ->add('visited', 'boolean')
    ->add('absolute_url', 'link')
;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A==" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <?php echo($table->render()); ?>
        </div>
    </body>
</html>
