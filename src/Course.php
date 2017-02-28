<?php

    class Course
    {
        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
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

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO courses (name) VALUES ('{$this->getName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();
            foreach($returned_courses as $course)
            {
                $name = $course['name'];
                $id = $course['id'];
                $new_course = new Course($name, $id);
                array_push($courses, $new_course);
            }

            return $courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses;");
            $GLOBALS['DB']->exec("DELETE FROM courses_students;");
        }

        static function find($id)
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses WHERE id = {$id};");
            $found_course = null;
            foreach($returned_courses as $course)
            {
                $name = $course['name'];
                $id = $course['id'];
                $found_course = new Course($name, $id);
            }
            return $found_course;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
        }

        function addStudent($new_student)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getId()}, {$new_student->getId()});");
        }

        function getStudents()
        {
            $all_students = array();
            $queried_students = $GLOBALS['DB']->query("SELECT students.* FROM courses
                JOIN courses_students ON (courses_students.course_id = courses.id)
                JOIN students ON (students.id = courses_students.student_id)
                WHERE courses.id = {$this->getId()};");
            foreach($queried_students as $student) {
                $name = $student['name'];
                $enrollment_date = $student['enrollment_date'];
                $id = $student['id'];
                $new_student = new Student($name, $enrollment_date, $id);
                array_push($all_students, $new_student);
            }
            return $all_students;
        }

    }

 ?>
