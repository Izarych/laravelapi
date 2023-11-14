<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use App\Http\Requests\UpdateCurriculumRequest;
use App\Models\Classes;
use App\Models\Curriculum;
use Illuminate\Http\JsonResponse;

class ClassesController extends Controller
{
    public function index(): JsonResponse
    {
        $classes = Classes::all();

        return response()->json([
            'data' => $classes
        ]);
    }

    public function show(Classes $class): JsonResponse
    {
        if ($classInfo = Classes::getInfo($class)) {
            return response()->json([
                'data' => $classInfo
            ]);
        }

        return response()->json([
            'message' => 'Класс не найден'
        ], 404);
    }

    public function getCurriculum(Classes $class): JsonResponse
    {
        if ($curriculum = Classes::getCurriculum($class)) {
            return response()->json([
                'data' => $curriculum
            ]);
        }

        return response()->json([
            'message' => 'Учебный план для класса не найден'
        ], 404);
    }

    public function updateCurriculum(UpdateCurriculumRequest $request): JsonResponse
    {
        if ($curriculum = Curriculum::updateCurriculum((array) $request->validated())) {
            return response()->json([
                'data' => $curriculum
            ]);
        }

        return response()->json([
            'message' => 'Произошла ошибка при создании/обновлении учебного плана'
        ], 400);
    }

    public function store(CreateClassesRequest $request): JsonResponse
    {
        if ($class = Classes::createClasses((array) $request->validated())) {
            return response()->json([
                'data' => $class
            ], 201);
        }

        return response()->json([
            'message' => 'Произошла ошибка при создании класса'
        ], 400);
    }

    public function update(UpdateClassesRequest $request, Classes $class): JsonResponse
    {
        if ($classes = Classes::classesUpdate((array) $request->validated(), $class)) {
            return response()->json([
                'data' => $classes
            ]);
        }

        return response()->json([
            'message' => 'Произошла ошибка при обновлении класса'
        ], 400);
    }

    public function destroy(Classes $class): JsonResponse
    {
        if (Classes::deleteClasses($class)) {
            return response()->json([
                'message' => 'Класс был успешно удален'
            ]);
        }

        return response()->json([
            'message' => 'Произошла ошибка при удалении класса'
        ], 400);
    }
}
