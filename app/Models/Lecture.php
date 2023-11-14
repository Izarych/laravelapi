<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme',
        'description'
    ];

    public function curriculum(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }

    public function attendedClasses(): BelongsToMany
    {
        return $this->belongsToMany(Classes::class, 'class_lecture');
    }

    public function attendedStudents(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_lecture');
    }

    public static function getInfo(Lecture $lecture): array
    {
        return [
            'theme' => $lecture->theme,
            'description' => $lecture->description,
            'classes' => $lecture->attendedClasses,
            'students' => $lecture->attendedStudents
        ];
    }

    public static function createLecture(array $data): ?Lecture
    {
        $lecture = new Lecture();

        $lecture->fill($data);

        return $lecture->save() ? $lecture : null;
    }

    public static function lectureUpdate(array $data, Lecture $lecture): ?Lecture
    {
        $lecture->fill($data);

        return $lecture->save() ? $lecture : null;
    }

    public static function deleteLecture(Lecture $lecture): bool
    {
        return $lecture->delete();
    }
}
