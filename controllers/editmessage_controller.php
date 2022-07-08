<?php

include dirname(__DIR__) .'/models.php';

class editmessageController {
    public function render(int $id) {
        // получение модели и чтение записи по id
        $model = new Message();
        $msg_data = $model->readOne($id);

        // если сообщение с таким id существует
        if ($msg_data) {
            // обработка POST-запроса
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['short_text'])  && isset($_POST['full_text']) ) {
                    $data_to_send = Array(
                        'title' => $_POST['title'],
                        'author' => $_POST['author'],
                        'short_text' => $_POST['short_text'],
                        'full_text' => $_POST['full_text']
                    );
                    $status = $model->edit($id, $data_to_send);
                    switch ($status) {
                        case 0:
                            $text_status = "Сообщение успешно обновлено!";
                            break;
                        case 1:
                            $text_status = "Проверьте свои данные! Возможно, они содержат пустые поля.";
                            break;
                        case 2:
                            $text_status = "Во время сохранения возникла ошибка, повторите операцию ещё раз!";
                            break;
                    }
                }
                // такой сценарий возможен, если кто-то в HTML-коде уберёт атрибуты required
                else {
                    $text_status = "Проверьте свои данные! Возможно, они содержат пустые поля.";
                }
            }

            // рендер представления
            require dirname(__DIR__) . '/views/editmessage_view.php';

        }
        // если сообщение с таким id нет - 404
        else {
            Error404::render();
        }
    }
}

