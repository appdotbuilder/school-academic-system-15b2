<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'employee_id' => 'required|string|unique:teachers,employee_id|max:50',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'hire_date' => 'required|date',
            'department' => 'required|string|max:255',
            'subject_specialization' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'employment_type' => 'required|in:full-time,part-time,contract',
            'status' => 'required|in:active,inactive,on-leave',
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
            'employee_id.required' => 'Employee ID is required.',
            'employee_id.unique' => 'This employee ID is already taken.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.unique' => 'This email is already registered.',
            'phone.required' => 'Phone number is required.',
            'address.required' => 'Address is required.',
            'date_of_birth.required' => 'Date of birth is required.',
            'hire_date.required' => 'Hire date is required.',
            'department.required' => 'Department is required.',
            'subject_specialization.required' => 'Subject specialization is required.',
            'qualification.required' => 'Qualification is required.',
            'salary.required' => 'Salary is required.',
            'employment_type.required' => 'Employment type is required.',
            'status.required' => 'Status is required.',
        ];
    }
}