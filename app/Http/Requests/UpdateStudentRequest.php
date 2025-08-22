<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'student_number' => 'required|string|unique:students,student_number,' . $this->route('student')->id . '|max:50',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $this->route('student')->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'guardian_email' => 'nullable|email',
            'grade_level' => 'required|string|max:10',
            'class_section' => 'nullable|string|max:10',
            'status' => 'required|in:active,inactive,graduated,transferred',
            'notes' => 'nullable|string',
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
            'student_number.required' => 'Student number is required.',
            'student_number.unique' => 'This student number is already taken by another student.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.unique' => 'This email is already registered to another student.',
            'date_of_birth.required' => 'Date of birth is required.',
            'address.required' => 'Address is required.',
            'guardian_name.required' => 'Guardian name is required.',
            'guardian_phone.required' => 'Guardian phone is required.',
            'grade_level.required' => 'Grade level is required.',
            'status.required' => 'Status is required.',
        ];
    }
}