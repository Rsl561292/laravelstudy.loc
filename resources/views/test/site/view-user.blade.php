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

    <?php
        if (!empty($userViewName)) {

            echo '<center>Page user ' . $userViewName . '</center>';
        } else {
            echo '<center>Page user</center><br/>';
            echo '<center>Record about selected user not found</center><br/>';
        }
    ?>
</body>
</html>