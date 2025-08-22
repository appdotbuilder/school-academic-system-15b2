<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'clock_in_time' => 'nullable|date_format:H:i',
            'clock_out_time' => 'nullable|date_format:H:i|after:clock_in_time',
            'status' => 'required|in:present,absent,late,half-day,on-leave',
            'leave_type' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'hours_worked' => 'nullable|numeric|min:0|max:24',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'teacher_id.required' => 'Teacher selection is required.',
            'teacher_id.exists' => 'Selected teacher does not exist.',
            'date.required' => 'Date is required.',
            'clock_in_time.date_format' => 'Clock in time must be in HH:MM format.',
            'clock_out_time.date_format' => 'Clock out time must be in HH:MM format.',
            'clock_out_time.after' => 'Clock out time must be after clock in time.',
            'status.required' => 'Status is required.',
            'status.in' => 'Invalid status selected.',
            'hours_worked.numeric' => 'Hours worked must be a number.',
            'hours_worked.max' => 'Hours worked cannot exceed 24 hours.',
        ];
    }
}