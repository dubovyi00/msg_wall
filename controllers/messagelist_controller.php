<?php

include dirname(__DIR__) .'/models.php';

class messagesListController {
    public function render(int $page = 1) {
        // получение модели
        $model = new Message();
        // получение количества страниц
        $pages_count = $model->pages();
        //  чтение всех записей
        $data = $model->readAll($page);
        // рендер страницы
        require dirname(__DIR__) . '/views/messages_list_view.php';
    }
}


