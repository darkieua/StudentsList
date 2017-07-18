<?php
    require_once '../framework/Loader.php';

    use framework\Loader;
    use framework\FrontController;

    $loader = new Loader();
    $loader->autoload();

    $frontController = new FrontController($_SERVER['REQUEST_URI']);

?>