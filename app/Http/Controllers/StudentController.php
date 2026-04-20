<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Subject;

class StudentController extends Controller
{
    // Lấy danh sách sinh viên
    public function index()
    {
        return Student::with('classroom')->get();
    }

    // Thêm sinh viên
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'class_id' => 'required|exists:classrooms,id'
        ]);

        return Student::create($request->all());
    }

    // Xem chi tiết
    public function show($id)
    {
        return Student::with('classroom', 'subjects')->findOrFail($id);
    }

    // Cập nhật
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return $student;
    }

    // Xóa
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return ['message' => 'Deleted'];
    }

    // Đăng ký môn học
    public function registerSubject($id, $subjectId)
    {
        $student = Student::findOrFail($id);

        $student->subjects()->attach($subjectId, [
            'registered_at' => now()
        ]);

        return ['message' => 'Registered'];
    }
}