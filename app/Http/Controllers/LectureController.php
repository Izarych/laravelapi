<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLectureRequest;
use App\Http\Requests\UpdateLectureRequest;
use App\Models\Lecture;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index(): JsonResponse
    {
        $lectures = Lecture::all();

        return response()->json([
            'data' => $lectures
        ]);
    }

    public function show(Lecture $lecture): JsonResponse
    {
        if ($lectureInfo = Lecture::getInfo($lecture)) {
            return response()->json([
                'data' => $lectureInfo
            ]);
        }

        return response()->json([
            'message' => 'Лекция не найдена'
        ], 404);
    }

    public function store(CreateLectureRequest $request): JsonResponse
    {
        if ($lecture = Lecture::createLecture((array) $request->validated())) {
            return response()->json([
                'data' => $lecture
            ], 201);
        }

        return response()->json([
            'message' => 'Произошла ошибка при создании лекции'
        ], 400);
    }

    public function update(UpdateLectureRequest $request, Lecture $lecture): JsonResponse
    {
        if ($lectures = Lecture::lectureUpdate((array) $request->validated(), $lecture)) {
            return response()->json([
                'data' => $lectures
            ]);
        }

        return response()->json([
            'message' => 'Произошла ошибка при обновлении лекции'
        ], 400);
    }

    public function destroy(Lecture $lecture): JsonResponse
    {
        if (Lecture::deleteLecture($lecture)) {
            return response()->json([
                'message' => 'Лекция была успешно удалена'
            ]);
        }

        return response()->json([
            'message' => 'Произошла ошибка при удалении лекции'
        ], 400);
    }
}
