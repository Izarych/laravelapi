<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Log;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function lectures() : BelongsToMany
    {
        return $this->belongsToMany(Lecture::class, 'class_lecture');
    }

    public function curriculum(): HasOne
    {
        return $this->hasOne(Curriculum::class);
    }

    public static function getInfo(Classes $class): array
    {
        return [
            'name' => $class->name,
            'students' => $class->students
        ];
    }

    public static function createClasses(array $data): ?Classes
    {
        $class = new Classes;
        $class->fill($data);

        return $class->save() ? $class : null;
    }

    public static function classesUpdate(array $data, Classes $class): ?Classes
    {
        $class->fill($data);

        return $class->save() ? $class : null;
    }

    public static function getCurriculum(Classes $class): ?Curriculum
    {
        return $class->curriculum;
    }

    public static function updateCurriculum(array $data): ?Classes
    {
        try {
            $class = self::find($data['class_id']);

            foreach ($data['lectures'] as $lecture) {
                // maybe updateOrCreate will be better
                $lecture = Lecture::find($lecture['id']);

                if ($lecture) {
                    $lecture->update($lecture);
                } else {
                    $lecture = new Lecture($lecture);
                    $class->lectures()->save($lecture);
                }
            }

            $class->order = $data['order'];

            $class->save();

            return $class;
        } catch (\Exception $e) {
            Log::error('Ошибка при создании/обновлении плана', (array) $e->getMessage());

            return null;
        }
    }

    public static function deleteClasses(Classes $class): bool
    {
        return $class->delete();
    }
}
