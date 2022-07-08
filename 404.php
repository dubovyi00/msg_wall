<?php

class Error404 {
    public function render() {
        // определяем заголовки запроса для получения соответствующего кода
        header('HTTP/1.1 404 Not Found');
        header('Content-type: text/html; charset=UTF-8');
        // рендер представления
        require __DIR__ . '/views/404_view.php';


    }
}