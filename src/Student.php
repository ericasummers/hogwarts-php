<?php
    class Student
    {
        private $name;
        private $enrollment_date;
        private $id;

        function __construct($name, $enrollment_date, $id = null)
        {
            $this->name = $name;
            $this->enrollment_date = $enrollment_date;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getEnrollmentDate()
        {
            return $this->enrollment_date;
        }

        function setEnrollmentDate($new_date)
        {
            $this->enrollment_date = (string) $new_date;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO students (name, enrollment_date) VALUES ('{$this->getName()}', '{$this->getEnrollmentDate()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $id = $student['id'];
                $new_student = new Student($name, $enrollment_date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function find($search_id)
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students WHERE id = {$search_id};");
            $found_student = null;
            foreach($returned_students as $student) {
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $id = $student['id'];
                $found_student = new Student($name, $enrollment_date, $id);
            }

            return $found_student;

        }

        function update($property, $value)
        {
            $GLOBALS['DB']->exec("UPDATE students SET {$property} = '{$value}' WHERE id = {$this->getId()};");
            $this->{$property} = $value;

        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
        }

        function removeFromCourse($course_id)
        {
            $GLOBALS['DB']->exec("DELETE FROM courses_students WHERE student_id = {$this->getId()} AND course_id = {$course_id};");
        }



    }




?>
