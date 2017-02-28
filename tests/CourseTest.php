<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";
    require_once "src/House.php";

    $server = 'mysql:host=localhost:8889;dbname=hogwarts_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
            //Arrange
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);


            //Act & Assert
            $this->assertEquals($test_course->getName(), $name);
        }


    }


 ?>
