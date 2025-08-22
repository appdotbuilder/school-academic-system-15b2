<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TeacherAttendance
 *
 * @property int $id
 * @property int $teacher_id
 * @property string $date
 * @property string|null $clock_in_time
 * @property string|null $clock_out_time
 * @property string $status
 * @property string|null $leave_type
 * @property string|null $notes
 * @property string|null $hours_worked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \App\Models\Teacher $teacher
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereClockInTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereClockOutTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereLeaveType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereHoursWorked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAttendance whereUpdatedAt($value)
 * @method static \Database\Factories\TeacherAttendanceFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class TeacherAttendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'teacher_id',
        'date',
        'clock_in_time',
        'clock_out_time',
        'status',
        'leave_type',
        'notes',
        'hours_worked',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'hours_worked' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the teacher associated with this attendance record.
     *
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}