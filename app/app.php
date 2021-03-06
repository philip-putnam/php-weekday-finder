<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Weekday.php';

    $app = new Silex\Application();
    $app['debug'] = true;

    $app->register(
        new Silex\Provider\TwigServiceProvider(),
        array('twig.path' => __DIR__.'/../views')
    );

    $app->get('/', function() use ($app) {

        $result = '';
        if ($_GET) {
            $new_weekday = new Weekday();
            $result = $new_weekday->WeekdayFinder($_GET["month"],$_GET["day"],$_GET["year"]);
        }
        return $app['twig']->render('weekday-finder.html.twig', array('result' => $result));
    });

    return $app;
?>
