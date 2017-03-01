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

        return $app['twig']->render('index.html.twig', array('courses' => Course::getAll(), 'students' => Student::getAll()));
    });

    $app->post("/add-course", function() use ($app) {
        $name = $_POST['name'];
        $new_course = new Course($name);
        $new_course->save();

        return $app['twig']->render('index.html.twig', array('courses' => Course::getAll(), 'students' => Student::getAll()));
    });

    $app->get("/courses/{id}", function($id) use ($app) {
        $course = Course::find($id);

        return $app['twig']->render('course.html.twig', array('course' => $course, 'course_students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->post("/add-student", function() use ($app) {
        $name = $_POST['name'];
        $enrollment_date = $_POST['enrollment_date'];
        $new_student = new Student($name, $enrollment_date);
        $new_student->save();
        $course_id = $_POST['course_id'];
        $course = Course::find($course_id);
        $course->addStudent($new_student);

        return $app['twig']->render('course.html.twig', array('course' => $course, 'course_students' => $course->getStudents(), 'all_students' =>Student::getAll()));
    });

    $app->post("/add-course-student", function() use ($app) {
        $course_id = $_POST['course_id'];
        $course = Course::find($course_id);
        $add_student = Student::find($_POST['students-list']);
        $course->addStudent($add_student);

        return $app['twig']->render('course.html.twig', array('course' => $course, 'course_students' => $course->getStudents(), 'all_students' => Student::getAll()));
    });

    $app->delete("/delete-student/{id}", function($id) use ($app) {
        $student = Student::find($id);
        $student->delete();

        return $app['twig']->render('index.html.twig', array('courses' => Course::getAll(), 'students' => Student::getAll()));
    });


    return $app;

?>
