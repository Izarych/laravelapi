<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $students = Student::all();

        return response()->json([
            'data' => $students
        ]);
    }

    public function show(Student $student): JsonResponse
    {
        if ($studentInfo = Student::getInfo($student)) {
            return response()->json([
                'data' => $studentInfo
            ]);
        }

        return response()->json([
            'message' => 'Ученик не найден'
        ], 404);
    }

    public function store(CreateStudentRequest $request): JsonResponse
    {
        if ($student = Student::createStudent((array) $request->validated())) {
            return response()->json([
                'data' => $student
            ], 201);
        }

        return response()->json([
            'message' => 'Произошла ошибка при создании ученика'
        ], 400);
    }

    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        if ($student = Student::studentUpdate((array) $request->validated(), $student)) {
            return response()->json([
                'data' => $student
            ]);
        }

        return response()->json([
            'message' => 'Произошла ошибка при обновлении ученика'
        ], 400);
    }

    public function destroy(Student $student): JsonResponse
    {
        if (Student::deleteStudent($student)) {
            return response()->json([
                'message' => 'Ученик был успешно удален'
            ]);
        }

        return response()->json([
            'message' => 'Произошла ошибка при удалении ученика'
        ], 400);
    }
}
