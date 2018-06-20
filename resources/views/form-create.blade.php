<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <h1>Created page</h1>
    <br/><br/><br/>

    <form action="/admin/pages" method="POST">
        {{ csrf_field() }}
        Ім'я: <input type="text" name="name"> <br/>
        Коментарій: <br/>
        <textarea name="text"></textarea> <br/>

        <input type="submit" value="Додати"/>
    </form>

</body>
</html>