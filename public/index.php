<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

$news = new News\NewsController();

if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $news->article($id);
} else {
    $news->index();
}
