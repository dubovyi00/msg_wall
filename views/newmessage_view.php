<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавление сообщения</title>
    <link rel="stylesheet" href=<?php echo "/style.css" ?> type="text/css"/>
</head>
<body>
    <header>
        <h1>Добавление сообщения</h1>
        <div class="line"></div>
        <nav><a href="/"><button class="navigate">Вернуться к списку</button></a></nav>

    </header>

    <main>
        <?php if (isset($text_status)) echo '<p class="status"><i>'.$text_status.'</i></p>'?>
        <div class="info-box">
            <form method='POST' id="message">
                <div>
                    <label for="title">Название: </label>
                    <input required="required" name="title" type="text" size="30" maxlength="30">
                </div>
                <div>
                    <label for="author">Автор: </label>
                    <input required="required" name="author" type="text" size="30" maxlength="30">
                </div>
                <div>
                    <label for="short_text">Короткий текст: </label>
                    <textarea required="required" name="short_text" maxlength="200" rows="4" cols="40"></textarea>
                </div>
                <div>
                    <label for="full_text">Полный текст:</label>
                    <textarea required="required" name="full_text" rows="4" cols="40"></textarea>
                </div>
                <div>
                    <input type="submit" value="Добавить">
                </div>
            </form>
        </div>

    </main>


    </body>
</html>
