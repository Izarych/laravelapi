<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'class_id'
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(Classes::class);
    }

    public function lectures() : BelongsToMany
    {
        return $this->belongsToMany(Lecture::class, 'student_lecture');
    }

    public static function getInfo(Student $student): array
    {
        return [
            'name' => $student->name,
            'email' => $student->email,
            'class' => $student->schoolClass,
            'lectures' => $student->lectures
        ];
    }

    public static function createStudent(array $data): ?Student
    {
        $student = new Student;
        $student->fill($data);

        return $student->save() ? $student : null;
    }

    public static function studentUpdate(array $data, Student $student): ?Student
    {
        $student->fill($data);

        return $student->save() ? $student : null;
    }

    public static function deleteStudent(Student $student) : bool
    {
        return $student->delete();
    }
}
