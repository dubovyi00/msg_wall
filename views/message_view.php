<!DOCTYPE html>
<html lang="ru">
    <head>
        <title><?php echo $msg_data['title']?></title>
        <link rel="stylesheet" href=<?php echo "/style.css" ?> type="text/css"/>
    </head>
    <body>
        <header>
            <h1>Просмотр сообщения</h1>
            <div class="line"></div>
            <a href="/"><button class="navigate">Вернуться к списку</button></a>
        </header>

        <main>
            <div class="info-box">
                <?php
                echo '<h2>'.$msg_data['title'].' (автор: '.$msg_data['author'].')</h2>';
                echo '<p>'.nl2br($msg_data['full_text']).'</p>';
                ?>
                <a href="/editmessage/<?php echo $msg_data['id'] ?>"><button class="msg">Редактировать</button></a>
            </div>
            <div class="info-box-2">
                <h2>Добавить комментарий:</h2>
                <form method='POST' id="comment">
                    <input type="hidden" name="msg" value=<?php echo $msg_data['id'] ?>>
                    <p>Автор: <input required="required" name="author" type="text"></p>
                    <p>Комментарий: <textarea required="required" name="text"></textarea></p>
                    <input type="submit" value="Отправить">
                    <?php if (isset($text_status)) echo '<p><i>'.$text_status.'</i></p>'?>
                </form>

                <?php
                if (count($comm_data) === 0) {
                    echo '<h2>Комментарии отсутствуют!</h2>';
                } else {
                    echo '<h2>Комментарии:</h2>';
                    foreach ($comm_data as $comm) {
                        echo '<div class="comment">';
                        echo '<p><i><b>'.$comm['author'].':</b></i><br>'.$comm['text'].'</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>

        </main>

    </body>
</html>