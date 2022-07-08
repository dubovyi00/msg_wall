<?php

// подключение к БД
$GLOBALS['conn'] = mysqli_connect('localhost', 'msg_wall', '2o33f39aDSA9!', 'msg_wall');

class Model {
    public $valid_types;

    // валидация данных
    private function validate(Array $data) {
        if (count($data) === count($this->valid_types)) {
            foreach ($data as $param => $value) {

                if (gettype($value) != $this->valid_types[$param][0] ||
                    ($this->valid_types[$param][0] === 'string' && strlen($value) < 0) ||
                    (isset($this->valid_types[$param][1]) && strlen($value) > $this->valid_types[$param][1]) ) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    // создание объекта модели
    public function create(Array $data) {
        if ($this->validate($data)) {
            $table_name = mb_strtolower(get_called_class()).'s';
            $data_str = '';
            foreach ($data as $param => $value) {
                $data_str .= $param." = '".$value."', ";
            }
            $query = 'INSERT INTO '.$table_name.' SET '.substr($data_str, 0, strlen($data_str)-2);
            $res = mysqli_query($GLOBALS['conn'], $query);
            if (!$res) {
                return 2;
            }
            return 0;
        } else {
            return 1;
        }
    }

    // чтение объекта модели по его id
    public function readOne(int $id) {
        $table_name = mb_strtolower(get_called_class()).'s';
        $query = 'SELECT * FROM '.$table_name.' WHERE id = '.$id;
        $res = mysqli_query($GLOBALS['conn'], $query);
        if (!$res) {
            return false;
        } else {
            return mysqli_fetch_array($res);
        }
    }

    // удаление объекта модели с таким id
    public function delete(int $id) {
        $table_name = mb_strtolower(get_called_class()).'s';
        $query = 'SELECT FROM '.$table_name.' WHERE id = '.$id;
        $res = mysqli_query($GLOBALS['conn'], $query);
        if (!$res) {
            return false;
        } else {
            return true;
        }
    }

    // редактирование объекта модели с таким id
    public function edit(int $id, Array $data) {
        if ($this->validate($data)) {
            $table_name = mb_strtolower(get_called_class()).'s';
            $data_str = '';
            foreach ($data as $param => $value) {
                $data_str .= $param." = '".$value."', ";
            }
            $query = 'UPDATE '.$table_name.' SET '.substr($data_str, 0, strlen($data_str)-2).' WHERE id = '.$id;
            $res = mysqli_query($GLOBALS['conn'], $query);
            if (!$res) {
                return 2;
            }
            return 0;
        } else {
            return 1;
        }
    }
}

class Message extends Model {
    public $valid_types = ['title' => ['string', 30],
                            'author' => ['string', 30],
                            'short_text' => ['string', 200],
                            'full_text' => ['string']];

    // собственный метод для чтения всех записей (пагинация по 10, необходимо указать страницу)
    public function readAll(int $page) {
        $constr = 10 * ($page - 1);
        $query = 'SELECT id, title, short_text FROM messages ORDER BY id LIMIT 10 OFFSET '.$constr;
        $res = mysqli_query($GLOBALS['conn'], $query);
        if (!$res) {
            return Array();
        } else return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    // получение количества страниц
    public function pages() {
        $query = 'SELECT COUNT(*) AS count FROM messages';
        $res = mysqli_query($GLOBALS['conn'], $query);
        $count = intdiv(mysqli_fetch_array($res)['count'], 10) + 1;
        return $count;
    }
}

class Comment extends Model  {
    public $valid_types = ['msg' => ['int'],
                            'author' => ['string', 30],
                            'text' => ['string']];

    // собственный метод для чтения всех записей (необходим id сообщения, записи выдаются по убыванию id)
    public function readAll(int $msg_id) {
        $query = 'SELECT author, text FROM comments WHERE msg = '.$msg_id.' ORDER BY id DESC';
        $res = mysqli_query($GLOBALS['conn'], $query);
        if (!$res) {
            return Array();
        } else return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
}


