<?php

include dirname(__DIR__) .'/models.php';

class newmessageController {
    public function render() {
        // получение модели
        $message_model = new Message();

        // сохранение сообщения
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['short_text'])  && isset($_POST['full_text']) ) {
                $data_to_send = Array(
                    'title' => $_POST['title'],
                    'author' => $_POST['author'],
                    'short_text' => $_POST['short_text'],
                    'full_text' => $_POST['full_text']
                );
                $status = $message_model->create($data_to_send);
                switch ($status) {
                    case 0:
                        $text_status = "Сообщение успешно добавлено!";
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

        require dirname(__DIR__) . '/views/newmessage_view.php';

    }

}