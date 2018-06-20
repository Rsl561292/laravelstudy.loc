<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <a href="{{route('home')}}}">Home</a>

    <br/>

    <form action="/view-comments-method-match" method="post">
        {{ csrf_field() }}
        Ім'я: <input type="text" name="name"> <br/>
        Коментарій: <br/>
        <textarea name="text"></textarea> <br/>

        <input type="submit" value="Додати"/>
    </form>
</body>
</html>