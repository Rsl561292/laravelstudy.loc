<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

    <?php
        $paths = config('view.paths');
        echo view()->file($paths[0] . '/admin/top-menu.php')->with('userName', $userName);
    ?>

    <center>Page list users site</center>

    <?php
        if(!empty($listUser)) {
            foreach ($listUser as $key => $value) {
                echo '<p>Open page user: <a href="' . route("admin-user", ['slug' => $key]) . '">' . $value . '</a></p>';
            }
        }
    ?>
</body>
</html>