<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $subject
 * @property string $grade_level
 * @property string $class_section
 * @property int $teacher_id
 * @property string $lesson_date
 * @property string $start_time
 * @property string $end_time
 * @property string $classroom
 * @property string $lesson_topic
 * @property string|null $lesson_objectives
 * @property string|null $curriculum_standards
 * @property string|null $materials_needed
 * @property string|null $homework_assigned
 * @property string $status
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Teacher $teacher
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereGradeLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereClassSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereLessonDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereClassroom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereLessonTopic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereLessonObjectives($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCurriculumStandards($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereMaterialsNeeded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereHomeworkAssigned($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 * @method static \Database\Factories\LessonFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'subject',
        'grade_level',
        'class_section',
        'teacher_id',
        'lesson_date',
        'start_time',
        'end_time',
        'classroom',
        'lesson_topic',
        'lesson_objectives',
        'curriculum_standards',
        'materials_needed',
        'homework_assigned',
        'status',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'lesson_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the teacher associated with this lesson.
     *
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}