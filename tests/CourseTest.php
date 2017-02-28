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

        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }

        function testGetName()
        {
            //Arrange
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);


            //Act & Assert
            $this->assertEquals($test_course->getName(), $name);
        }

        function testSave()
        {
            //Arrange
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);

            //Act
            $test_course->save();

            //Assert
            $this->assertEquals([$test_course], Course::getAll());

        }

        function testGetAll()
        {
            //Arrange
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);
            $test_course->save();

            $name2 = "Potions";
            $test_course2 = new Course($name2);
            $test_course2->save();


            //Act & //Assert
            $this->assertEquals([$test_course, $test_course2], Course::getAll());
        }

        function testDeleteAll()
        {
            //Arrange
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);
            $test_course->save();

            $name2 = "Potions";
            $test_course2 = new Course($name2);
            $test_course2->save();

            Course::deleteAll();

            //Act & //Assert
            $this->assertEquals([], Course::getAll());
        }

        function testFind()
        {
            //Arrange
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);
            $test_course->save();

            $name2 = "Potions";
            $test_course2 = new Course($name2);
            $test_course2->save();

            //Act
            $result = Course::find($test_course->getId());

            //Assert
            $this->assertEquals($test_course, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);
            $test_course->save();
            $new_name = "Charms";

            $test_course->update($new_name);

            $this->assertEquals($new_name, $test_course->getName());
        }

        function testDelete()
        {
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);
            $test_course->save();

            $name2 = "Potions";
            $test_course2 = new Course($name2);
            $test_course2->save();

            //Act
            $test_course2->delete();

            //Assert
            $this->assertEquals([$test_course], Course::getAll());
        }

        function test_AddAndGetStudents()
        {
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);
            $test_course->save();

            $name = "Harry Potter";
            $enrollment_date = "2/02/2000";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "Hermione Granger";
            $enrollment_date2 = "04/01/2000";
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();

            $test_course->addStudent($test_student);

            $this->assertEquals($test_course->getStudents(), [$test_student]);
        }

        function test_GetStudents()
        {
            $name = "Defense Against the Dark Arts";
            $test_course = new Course($name);
            $test_course->save();

            $name = "Harry Potter";
            $enrollment_date = "2/02/2000";
            $test_student = new Student($name, $enrollment_date);
            $test_student->save();

            $name2 = "Hermione Granger";
            $enrollment_date2 = "04/01/2000";
            $test_student2 = new Student($name2, $enrollment_date2);
            $test_student2->save();

            $test_course->addStudent($test_student);
            $test_course->addStudent($test_student2);

            $this->assertEquals($test_course->getStudents(), [$test_student, $test_student2]);
        }


    }


 ?>
