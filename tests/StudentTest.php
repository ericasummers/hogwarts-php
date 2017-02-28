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

    class StudentTest extends PHPUnit_Framework_TestCase
    {

        function testGetName()
        {
            //Arrange
            $name = "Harry Potter";
            $enrollment_date = "2-02-2000";
            $test_student = new Student($name, $enrollment_date);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            //Arrange
            $name = "Harry Potter";
            $enrollment_date = "2-02-2000";
            $test_student = new Student($name, $enrollment_date);

            //Act
            $new_name = "Hermione Granger";
            $test_student->setName($new_name);

            //Assert
            $this->assertEquals($new_name, $test_student->getName());
        }


    }


 ?>
