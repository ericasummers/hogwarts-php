<?php
    class Student
    {
        private $id;
        private $name;
        private $enrollment_date;

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
            return $this->id = $id;
        }







    }




?>
