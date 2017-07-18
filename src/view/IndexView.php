<html>
<head>
    <title><? echo (!empty($title) ? $title : 'Список студентов') ?></title>
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/app.css">
</head>

<body>
    <div class="container">
        <h1><a class="title-link" href="/">Список студентов</a></h1>
        <div class="col-lg-12 well">
            <? echo $indexContent; ?>
        </div>
    </div>

    <script src="/public/js/jquery-3.2.1.min.js"></script>
    <script src="/public/js/app.js"></script>
</body>
</html>