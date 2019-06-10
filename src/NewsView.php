<?php

namespace News;

class NewsView {
    protected $data = array();
    protected $render = false;

    public function __construct($template)
    {
        
        $file = dirname(__DIR__) . '/src/templates/' . strtolower($template) . '.tpl.php';

        if (file_exists($file)) {
            $this->render = $file;
        } else {
            echo 'Template ' . $template . ' not found!';
        }
    }

    public function assign($variable, $value)
    {
        $this->data[$variable] = $value;
    }

    public function __destruct()
    {
        extract($this->data);
        include($this->render);
    }
}
