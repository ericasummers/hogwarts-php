<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Course.php";
    require_once __DIR__."/../src/Student.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hogwarts';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {

        return $app['twig']->render('index.html.twig', array('courses' => Course::getAll()));
    });

    $app->post("/add-course", function() use ($app) {
        $name = $_POST['name'];
        $new_course = new Course($name);
        $new_course->save();

        return $app['twig']->render('index.html.twig', array('courses' => Course::getAll()));
    });

    return $app;

?>
