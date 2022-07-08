<?php

include '404.php';

class Router {
    public function run() {
        // по умолчанию - запуск контроллера для вывода списка сообщений (основной страницы)
        $ctrl_file = 'controllers/messagelist_controller.php';
        $controller = 'messagesListController';
        // парсинг адреса
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        // если необходимо получить другое окно - заменяем имя контроллера
        if (!empty($routes[1])) {
            if ($routes[1] != 'page') {
                $ctrl_file = 'controllers/'.$routes[1].'_controller.php';
                $controller = $routes[1].'Controller';
            }
        }
        // проверяем наличие файла с заданным контроллером и, таким образом, его существование
        if (file_exists($ctrl_file)) {
            include $ctrl_file;
            $ctrl = new $controller;
            /* проверяем наличие идентификатора

            Поведение следующее: если есть и такой контроллер, и задан идентификатор - обращаемся к контроллеру с
            передачей параметра (страница, идентификатор сообщения)
            Если задан контроллер основной страницы или добавления сообщения и нет идентификатора - обращаемся к
            контроллеру без передачи параметра, поскольку первый контроллер имеет по умолчанию $page = 1,
            второй же параметров не принимает
            В остальных же случаях - 404

            */
            $without_params = ['messagesListController', 'newmessageController']; // контроллеры, которые могут не
                                                                                  // не требовать параметров

            if (!empty($routes[2]) and !empty($routes[1])) $ctrl->render($routes[2]);
            else if (in_array($controller, $without_params) && empty($routes[2])) $ctrl->render();
            else Error404::render();

        } else {
            // если такого контроллера нет - 404
            Error404::render();
        }

    }
}

