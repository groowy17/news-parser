<?php
namespace News;
use Exception;

class NewsParser {
    protected $url = 'https://www.rbc.ru/';
    
    function __construct()
	{
        $this->model = new NewsModel();
        $this->text = file_get_contents($this->url);
    }

    public function run() {
        try {
            $this->dropArticles();
            $this->saveArticles();
            header('Location: /');
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function getLinks() {
        $reg = '/<a href="(.*?)\?from=newsfeed"/im';
        preg_match_all($reg, $this->text , $res);

        return $res[1];
    }

    private function getContentsFromUrl($url) {
        return $text = file_get_contents($url);
    }

    private function getTitle($text) {
        $reg = '/<meta property="og:title" content="(.*?)" \\/>/is';
        preg_match_all($reg, $text , $res);

        return strip_tags(reset($res[1]));
    }

    private function getDescription($text) {
        $reg = '/<meta property="og:description" content="(.*?)" \\/>/is';
        preg_match_all($reg, $text, $res);

        return strip_tags(reset($res[1]));
    }

    private function getFullText($text) {
        $reg = '/<p>(.*?)<\\/p>/is';
        preg_match_all($reg, $text, $res);

        return strip_tags(join('<br>',$res[1]), '<br>');
    }

    private function getImg($text) {
        $reg = '/<div class="article__main-image__wrap">(\s*?)<img src="(.*?)" /is';
        preg_match_all($reg, $text, $res);

        return reset($res[2]);
    }

    private function getDate($text) {
        $reg = '/<meta itemprop="dateModified" content="(.*?)"\\/>/is';
        preg_match_all($reg, $text, $res);

        return reset($res[1]);
    }

    private function saveArticles() {
        $links = $this->getLinks();
        $data = [];

        foreach ($links as $key => $value) {
            $text = $this->getContentsFromUrl($value);

            $data[$key] = [
                ':title'=> $this->getTitle($text),
                ':description' => $this->getDescription($text),
                ':fulltext' => $this->getFullText($text),
                ':img' => $this->getImg($text),
                ':date'=> date("Y-m-d H:i:s",strtotime($this->getDate($text)))
            ];
        }
        try {
            $this->model->saveArticles($data);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function dropArticles() {
        return $this->model->dropArticles();
    }
}
