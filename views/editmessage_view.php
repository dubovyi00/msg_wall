<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Изменение сообщения</title>
    <link rel="stylesheet" href=<?php echo "/style.css" ?> type="text/css"/>
</head>
<body>
    <header>
        <h1>Изменение сообщения</h1>
        <div class="line"></div>
        <nav>
            <a href="/"><button class="navigate">Вернуться к списку</button></a>
        </nav>
    </header>

    <main>
        <div class="info-box">
            <?php if (isset($text_status)) echo '<p><i>'.$text_status.'</i></p>'?>
            <form method='POST' id="message">
                <div>
                    <label for="title">Название: </label>
                    <input required="required" name="title" type="text" size="30" maxlength="30" value=<?php echo $msg_data['title'] ?>>
                </div>
                <div>
                    <label for="author">Автор: </label>
                    <input required="required" name="author" type="text" size="30" maxlength="30" value=<?php echo $msg_data['author'] ?>>
                </div>
                <div>
                    <label for="short_text">Короткий текст: </label>
                    <textarea required="required" name="short_text" maxlength="200" rows="4" cols="40"><?php echo $msg_data['short_text']?></textarea>
                </div>
                <div>
                    <label for="full_text">Полный текст:</label>
                    <textarea required="required" name="full_text" rows="4" cols="40"><?php echo $msg_data['full_text']?></textarea>
                </div>
                <div>
                    <input type="submit" value="Обновить">
                </div>

            </form>
        </div>
    </main>

</body>
</html>
