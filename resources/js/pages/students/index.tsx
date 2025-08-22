import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Students', href: '/students' },
];

interface Student {
    id: number;
    student_number: string;
    first_name: string;
    last_name: string;
    email: string;
    phone?: string;
    grade_level: string;
    class_section?: string;
    status: string;
    guardian_name: string;
    guardian_phone: string;
    created_at: string;
    full_name: string;
}

interface PaginationData {
    data: Student[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

interface Props {
    students: PaginationData;
    [key: string]: unknown;
}

export default function StudentsIndex({ students }: Props) {
    const getStatusBadgeClass = (status: string) => {
        switch (status) {
            case 'active':
                return 'bg-green-100 text-green-800';
            case 'inactive':
                return 'bg-gray-100 text-gray-800';
            case 'graduated':
                return 'bg-blue-100 text-blue-800';
            case 'transferred':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Students - EduTrack" />
            
            <div className="space-y-6 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900">👨‍🎓 Students Management</h1>
                        <p className="text-gray-600 mt-2">Manage all student records and information</p>
                    </div>
                    <Link href="/students/create">
                        <Button>Add New Student</Button>
                    </Link>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-blue-600">{students.total}</div>
                        <div className="text-sm text-blue-700">Total Students</div>
                    </div>
                    <div className="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-green-600">
                            {students.data.filter(s => s.status === 'active').length}
                        </div>
                        <div className="text-sm text-green-700">Active Students</div>
                    </div>
                    <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-yellow-600">
                            {students.data.filter(s => s.status === 'graduated').length}
                        </div>
                        <div className="text-sm text-yellow-700">Graduated</div>
                    </div>
                    <div className="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-purple-600">
                            {new Set(students.data.map(s => s.grade_level)).size}
                        </div>
                        <div className="text-sm text-purple-700">Grade Levels</div>
                    </div>
                </div>

                {/* Students Table */}
                <div className="bg-white rounded-lg shadow border">
                    <div className="px-6 py-4 border-b">
                        <h2 className="text-lg font-semibold text-gray-900">Student Directory</h2>
                    </div>
                    <div className="overflow-x-auto">
                        <table className="w-full">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Student
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grade & Section
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Guardian
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody className="bg-white divide-y divide-gray-200">
                                {students.data.map((student) => (
                                    <tr key={student.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div className="text-sm font-medium text-gray-900">
                                                    {student.full_name}
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    ID: {student.student_number}
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div className="text-sm text-gray-900">{student.email}</div>
                                                {student.phone && (
                                                    <div className="text-sm text-gray-500">{student.phone}</div>
                                                )}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm text-gray-900">
                                                Grade {student.grade_level}
                                                {student.class_section && ` - ${student.class_section}`}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div className="text-sm text-gray-900">{student.guardian_name}</div>
                                                <div className="text-sm text-gray-500">{student.guardian_phone}</div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(student.status)}`}>
                                                {student.status}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div className="flex space-x-2">
                                                <Link href={`/students/${student.id}`}>
                                                    <Button variant="outline" size="sm">View</Button>
                                                </Link>
                                                <Link href={`/students/${student.id}/edit`}>
                                                    <Button variant="outline" size="sm">Edit</Button>
                                                </Link>
                                            </div>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                    
                    {/* Pagination */}
                    {students.last_page > 1 && (
                        <div className="px-6 py-4 border-t bg-gray-50">
                            <div className="flex items-center justify-between">
                                <div className="text-sm text-gray-700">
                                    Showing {((students.current_page - 1) * students.per_page) + 1} to{' '}
                                    {Math.min(students.current_page * students.per_page, students.total)} of{' '}
                                    {students.total} results
                                </div>
                                <div className="flex space-x-2">
                                    {students.current_page > 1 && (
                                        <Link href={`/students?page=${students.current_page - 1}`}>
                                            <Button variant="outline" size="sm">Previous</Button>
                                        </Link>
                                    )}
                                    {students.current_page < students.last_page && (
                                        <Link href={`/students?page=${students.current_page + 1}`}>
                                            <Button variant="outline" size="sm">Next</Button>
                                        </Link>
                                    )}
                                </div>
                            </div>
                        </div>
                    )}
                </div>

                {/* Empty State */}
                {students.total === 0 && (
                    <div className="bg-white rounded-lg shadow border p-12 text-center">
                        <div className="text-4xl mb-4">📚</div>
                        <h3 className="text-lg font-medium text-gray-900 mb-2">No students found</h3>
                        <p className="text-gray-500 mb-6">Get started by adding your first student to the system.</p>
                        <Link href="/students/create">
                            <Button>Add First Student</Button>
                        </Link>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}