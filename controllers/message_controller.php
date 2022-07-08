<?php

include dirname(__DIR__) .'/models.php';

class messageController {
    public function render(int $id) {
        // получение моделей и чтение записи по id
        $message_model = new Message();
        $comment_model = new Comment();
        $msg_data = $message_model->readOne($id);

        // если сообщение с таким id существует
        if ($msg_data) {
            if (isset($_POST['author']) && isset($_POST['text']) ) {
                $data_to_send = Array('msg' => (int)$_POST['msg'],
                                      'author' => $_POST['author'],
                                      'text' => $_POST['text']);
                $status = $comment_model->create($data_to_send);
                switch ($status) {
                    case 0:
                        $text_status = "Комментарий успешно добавлен!";
                        break;
                    case 1:
                        $text_status = "Проверьте свои данные! Возможно, они содержат пустые поля.";
                        break;
                    case 2:
                        $text_status = "Во время сохранения возникла ошибка, повторите операцию ещё раз!";
                        break;
                }
            }
            $comm_data = $comment_model->readAll($id);
            // рендер представления
            require dirname(__DIR__) . '/views/message_view.php';
        }
        // если сообщение с таким id нет - 404
        else {
            Error404::render();
        }
    }

}