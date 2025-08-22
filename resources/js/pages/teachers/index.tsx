import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Teachers', href: '/teachers' },
];

interface Teacher {
    id: number;
    employee_id: string;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    department: string;
    subject_specialization: string;
    qualification: string;
    employment_type: string;
    status: string;
    hire_date: string;
    created_at: string;
    full_name: string;
    attendances?: Array<{
        id: number;
        date: string;
        status: string;
    }>;
}

interface PaginationData {
    data: Teacher[];
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
}

interface Props {
    teachers: PaginationData;
    [key: string]: unknown;
}

export default function TeachersIndex({ teachers }: Props) {
    const getStatusBadgeClass = (status: string) => {
        switch (status) {
            case 'active':
                return 'bg-green-100 text-green-800';
            case 'inactive':
                return 'bg-gray-100 text-gray-800';
            case 'on-leave':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    const getEmploymentTypeBadge = (type: string) => {
        switch (type) {
            case 'full-time':
                return 'bg-blue-100 text-blue-800';
            case 'part-time':
                return 'bg-purple-100 text-purple-800';
            case 'contract':
                return 'bg-orange-100 text-orange-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Teachers - EduTrack" />
            
            <div className="space-y-6 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900">👨‍🏫 Teachers Management</h1>
                        <p className="text-gray-600 mt-2">Manage all teacher records and information</p>
                    </div>
                    <Link href="/teachers/create">
                        <Button>Add New Teacher</Button>
                    </Link>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-blue-600">{teachers.total}</div>
                        <div className="text-sm text-blue-700">Total Teachers</div>
                    </div>
                    <div className="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-green-600">
                            {teachers.data.filter(t => t.status === 'active').length}
                        </div>
                        <div className="text-sm text-green-700">Active Teachers</div>
                    </div>
                    <div className="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-purple-600">
                            {new Set(teachers.data.map(t => t.department)).size}
                        </div>
                        <div className="text-sm text-purple-700">Departments</div>
                    </div>
                    <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div className="text-2xl font-bold text-yellow-600">
                            {teachers.data.filter(t => t.employment_type === 'full-time').length}
                        </div>
                        <div className="text-sm text-yellow-700">Full-time</div>
                    </div>
                </div>

                {/* Teachers Table */}
                <div className="bg-white rounded-lg shadow border">
                    <div className="px-6 py-4 border-b">
                        <h2 className="text-lg font-semibold text-gray-900">Teacher Directory</h2>
                    </div>
                    <div className="overflow-x-auto">
                        <table className="w-full">
                            <thead className="bg-gray-50">
                                <tr>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Teacher
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contact
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Department
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
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
                                {teachers.data.map((teacher) => (
                                    <tr key={teacher.id} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div className="text-sm font-medium text-gray-900">
                                                    {teacher.full_name}
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    ID: {teacher.employee_id}
                                                </div>
                                                <div className="text-sm text-gray-500">
                                                    {teacher.qualification}
                                                </div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div className="text-sm text-gray-900">{teacher.email}</div>
                                                <div className="text-sm text-gray-500">{teacher.phone}</div>
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm text-gray-900">{teacher.department}</div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <div className="text-sm text-gray-900">{teacher.subject_specialization}</div>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getEmploymentTypeBadge(teacher.employment_type)}`}>
                                                {teacher.employment_type}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            <span className={`inline-flex px-2 py-1 text-xs font-semibold rounded-full ${getStatusBadgeClass(teacher.status)}`}>
                                                {teacher.status}
                                            </span>
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div className="flex space-x-2">
                                                <Link href={`/teachers/${teacher.id}`}>
                                                    <Button variant="outline" size="sm">View</Button>
                                                </Link>
                                                <Link href={`/teachers/${teacher.id}/edit`}>
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
                    {teachers.last_page > 1 && (
                        <div className="px-6 py-4 border-t bg-gray-50">
                            <div className="flex items-center justify-between">
                                <div className="text-sm text-gray-700">
                                    Showing {((teachers.current_page - 1) * teachers.per_page) + 1} to{' '}
                                    {Math.min(teachers.current_page * teachers.per_page, teachers.total)} of{' '}
                                    {teachers.total} results
                                </div>
                                <div className="flex space-x-2">
                                    {teachers.current_page > 1 && (
                                        <Link href={`/teachers?page=${teachers.current_page - 1}`}>
                                            <Button variant="outline" size="sm">Previous</Button>
                                        </Link>
                                    )}
                                    {teachers.current_page < teachers.last_page && (
                                        <Link href={`/teachers?page=${teachers.current_page + 1}`}>
                                            <Button variant="outline" size="sm">Next</Button>
                                        </Link>
                                    )}
                                </div>
                            </div>
                        </div>
                    )}
                </div>

                {/* Empty State */}
                {teachers.total === 0 && (
                    <div className="bg-white rounded-lg shadow border p-12 text-center">
                        <div className="text-4xl mb-4">👨‍🏫</div>
                        <h3 className="text-lg font-medium text-gray-900 mb-2">No teachers found</h3>
                        <p className="text-gray-500 mb-6">Get started by adding your first teacher to the system.</p>
                        <Link href="/teachers/create">
                            <Button>Add First Teacher</Button>
                        </Link>
                    </div>
                )}
            </div>
        </AppLayout>
    );
}