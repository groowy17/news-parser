<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

$parser = new News\NewsParser();

$parser->run();
