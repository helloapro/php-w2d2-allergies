<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/allergies.php";

    $app = new Silex\Application();
    $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->post('/process', function() use ($app) {
        $input = $_POST['allergyScore'];
        $new_allergy = new Allergies;
        $result = explode(" ", $new_allergy->checkAllergy($input));

        return $app['twig']->render('results.html.twig', array('result'=>$result));
    });

    return $app;
?>
