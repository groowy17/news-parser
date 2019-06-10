<?php
namespace News;

class NewsController {

    function __construct()
	{
        $this->model = new NewsModel();
        $this->view = 'News\NewsView';
    }

    public function index() {
        $view = new $this->view('main');
        $view->assign('articles', $this->getAllArticles());
    }

    public function article($id) {
        $view = new $this->view('article');
        $view->assign('article', $this->getArticle($id));
    }

    private function getAllArticles() {
        return $this->model->getAllArticles(); 
    }

    private function getArticle($id) {
        return $this->model->getArticle($id);
    }
}
