<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="<?= assets('bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= assets('style.css')?>">

</head>
<body>
    <header class="bg-dark"><?=$views['header_view']?></header>

    <? if ($data === []): ?>
    <form action="add.users" method="post" enctype="multipart/form-data">
        <input  type="file" name="file" /> <br/>
        <input type="submit" name="submit" />
    </form>
    <? else: ?>
        <table>
            <tr>
                <td>LOGIN</td>
                <td>STATUS</td>
            </tr>
            <? foreach ($data as $user): ?>
                <tr>
                    <td><?= $user['login'] ?></td>
                    <td><?= $user['status'] ?></td>
                </tr>
            <? endforeach; ?>
        </table>
    <? endif; ?>
</body>
</html>