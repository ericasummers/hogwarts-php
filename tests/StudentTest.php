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

        protected function tearDown()
        {
            Student::deleteAll();
        }

        function testGetName()
        {
            //Arrange
            $name = "Harry Potter";
            $enrollment_date = "2/02/2000";
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
            $enrollment_date = "2/02/2000";
            $test_student = new Student($name, $enrollment_date);

            //Act
            $new_name = "Hermione Granger";
            $test_student->setName($new_name);

            //Assert
            $this->assertEquals($new_name, $test_student->getName());
        }

        function testSaveAndGetAll()
        {
            $name = "Harry Potter";
            $enrollment_date = "2/02/2000";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "Hermione Granger";
            $enrollment_date2 = "04/01/2000";
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();

            $result = Student::getAll();

            $this->assertEquals([$test_student, $test_student2], $result);
        }

        function testFind()
        {
             //Arrange
            $name = "Harry Potter";
            $enrollment_date = "2/02/2000";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "Hermione Granger";
            $enrollment_date2 = "04/01/2000";
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();

            //Act
            $result = Student::find($test_student->getId());

            //Assert
            $this->assertEquals($test_student, $result);


        }


    }


 ?>
