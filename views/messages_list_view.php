<?php

function page_buttons_render($page_count, $current) {
    echo '<div>';
    if ($page_count <= 7) {
        for ($i = 1; $i <= $page_count; $i++) {
            echo '<a href="/page/'.$i.'"><button class="'.(($i !== $current) ? "page" : "page-current").'">'.$i.'</button></a>';
        }
    } else {
        if ($current <= 4) {
            for ($i = 1; $i <= 5; $i++) {
                echo '<a href="/page/'.$i.'"><button class="'.(($i !== $current) ? "page" : "page-current").'">'.$i.'</button></a>';
            }
            echo '...';
            echo '<a href="/page/'.$page_count.'"><button class="page">'.$page_count.'</button></a>';
        } else if ($current >= $page_count-3) {
            echo '<a href="/page/1"><button class="page">1</button></a>';
            echo '...';
            for ($i = $page_count-4; $i <= $page_count; $i++) {
                echo '<a href="/page/'.$i.'"><button class="'.(($i !== $current) ? "page" : "page-current").'">'.$i.'</button></a>';
            }
        } else {
            echo '<a href="/page/1"><button class="page">1</button></a>';
            echo '...';
            for ($i = $current-2; $i <= $current+2; $i++) {
                echo '<a href="/page/'.$i.'"><button class="'.(($i !== $current) ? "page" : "page-current").'">'.$i.'</button></a>';

            }
            echo '...';
            echo '<a href="/page/'.$page_count.'"><button class="page">'.$page_count.'</button></a>';
        }
    }
    echo '</div>';
}

?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Список сообщений</title>
        <link rel="stylesheet" href=<?php echo "/style.css" ?> type="text/css"/>
    </head>
    <body>
        <header>
            <h1>Список сообщений</h1>
            <div class="line"></div>
            <nav><a href="/newmessage"><button class="navigate">Добавить сообщение</button></a></nav>

        </header>

        <main>

            <?php
            if (count($data) != 0) {

                foreach($data as $m) {
                    echo '<a href="/message/'.$m['id'].'" class="message-button"><div class="info-box message-button">';
                    echo '<div class="msg-id">#'.$m['id'].'</div>';
                    echo '<h2>'.$m['title'].'</h2><p>'. nl2br($m['short_text']).'</p>';
                    echo '</div></a>';
                }
                page_buttons_render($pages_count, $page);

            } else {
                echo '<p>Сообщения отсутствуют!</p>';
            }

            ?>
        </main>

    </body>
</html>