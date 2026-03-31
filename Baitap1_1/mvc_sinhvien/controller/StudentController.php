<?php

require_once "./model/Student.php";

class StudentController
{

    public function index()
    {

        $students = Student::getAllStudents();

        include "./view/student_view.php";
    }
}
