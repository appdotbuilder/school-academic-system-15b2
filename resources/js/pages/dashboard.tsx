import React from 'react';
import AppLayout from '@/layouts/app-layout';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface Teacher {
    id: number;
    first_name: string;
    last_name: string;
    employee_id: string;
    full_name: string;
}

interface TeacherAttendance {
    id: number;
    date: string;
    status: string;
    clock_in_time?: string;
    clock_out_time?: string;
    teacher: Teacher;
}

interface Lesson {
    id: number;
    subject: string;
    lesson_topic: string;
    lesson_date: string;
    start_time: string;
    end_time: string;
    classroom: string;
    grade_level: string;
    class_section: string;
    status: string;
    teacher: Teacher;
}

interface Stats {
    total_students: number;
    total_teachers: number;
    total_staff: number;
    present_teachers_today: number;
    absent_teachers_today: number;
    scheduled_lessons_today: number;
    completed_lessons_today: number;
}

interface Props {
    stats: Stats;
    recentAttendances: TeacherAttendance[];
    upcomingLessons: Lesson[];
    todaysLessons: Lesson[];
    [key: string]: unknown;
}

export default function Dashboard({ stats, recentAttendances, upcomingLessons, todaysLessons }: Props) {
    const getStatusBadgeClass = (status: string) => {
        switch (status) {
            case 'present':
                return 'bg-green-100 text-green-800';
            case 'absent':
                return 'bg-red-100 text-red-800';
            case 'late':
                return 'bg-yellow-100 text-yellow-800';
            case 'on-leave':
                return 'bg-blue-100 text-blue-800';
            case 'scheduled':
                return 'bg-blue-100 text-blue-800';
            case 'completed':
                return 'bg-green-100 text-green-800';
            case 'cancelled':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard - EduTrack" />
            
            <div className="space-y-8 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900">📊 School Dashboard</h1>
                        <p className="text-gray-600 mt-2">Welcome to your school management system</p>
                    </div>
                    <div className="flex space-x-3">
                        <Link href="/teachers/create">
                            <Button size="sm">Add Teacher</Button>
                        </Link>
                        <Link href="/students/create">
                            <Button size="sm">Add Student</Button>
                        </Link>
                        <Link href="/lessons/create">
                            <Button size="sm">Schedule Lesson</Button>
                        </Link>
                    </div>
                </div>

                {/* Statistics Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div className="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <div className="flex items-center">
                            <div className="text-2xl mr-3">👨‍🎓</div>
                            <div>
                                <p className="text-sm font-medium text-blue-600">Total Students</p>
                                <p className="text-3xl font-bold text-blue-900">{stats.total_students}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-green-50 border border-green-200 rounded-lg p-6">
                        <div className="flex items-center">
                            <div className="text-2xl mr-3">👨‍🏫</div>
                            <div>
                                <p className="text-sm font-medium text-green-600">Total Teachers</p>
                                <p className="text-3xl font-bold text-green-900">{stats.total_teachers}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-purple-50 border border-purple-200 rounded-lg p-6">
                        <div className="flex items-center">
                            <div className="text-2xl mr-3">👥</div>
                            <div>
                                <p className="text-sm font-medium text-purple-600">Total Staff</p>
                                <p className="text-3xl font-bold text-purple-900">{stats.total_staff}</p>
                            </div>
                        </div>
                    </div>

                    <div className="bg-orange-50 border border-orange-200 rounded-lg p-6">
                        <div className="flex items-center">
                            <div className="text-2xl mr-3">📅</div>
                            <div>
                                <p className="text-sm font-medium text-orange-600">Today's Lessons</p>
                                <p className="text-3xl font-bold text-orange-900">{stats.scheduled_lessons_today + stats.completed_lessons_today}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Today's Overview */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Teacher Attendance Today */}
                    <div className="bg-white rounded-lg shadow-md border p-6">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900">📊 Teacher Attendance Today</h3>
                            <Link href="/attendances">
                                <Button variant="outline" size="sm">View All</Button>
                            </Link>
                        </div>
                        
                        <div className="grid grid-cols-2 gap-4 mb-4">
                            <div className="text-center p-4 bg-green-50 rounded-lg">
                                <div className="text-2xl font-bold text-green-600">{stats.present_teachers_today}</div>
                                <div className="text-sm text-green-700">Present</div>
                            </div>
                            <div className="text-center p-4 bg-red-50 rounded-lg">
                                <div className="text-2xl font-bold text-red-600">{stats.absent_teachers_today}</div>
                                <div className="text-sm text-red-700">Absent</div>
                            </div>
                        </div>
                        
                        <Link href="/attendances/create">
                            <Button className="w-full" size="sm">Mark Attendance</Button>
                        </Link>
                    </div>

                    {/* Today's Lessons */}
                    <div className="bg-white rounded-lg shadow-md border p-6">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900">📚 Today's Lessons</h3>
                            <Link href="/lessons">
                                <Button variant="outline" size="sm">View All</Button>
                            </Link>
                        </div>
                        
                        <div className="space-y-3 max-h-64 overflow-y-auto">
                            {todaysLessons.length > 0 ? (
                                todaysLessons.map((lesson) => (
                                    <div key={lesson.id} className="border rounded-lg p-3">
                                        <div className="flex items-center justify-between">
                                            <div>
                                                <p className="font-medium text-gray-900">{lesson.subject}</p>
                                                <p className="text-sm text-gray-600">
                                                    {lesson.start_time} - {lesson.end_time} | {lesson.classroom}
                                                </p>
                                                <p className="text-sm text-gray-500">
                                                    Grade {lesson.grade_level}{lesson.class_section} | {lesson.teacher.full_name}
                                                </p>
                                            </div>
                                            <span className={`px-2 py-1 text-xs font-medium rounded-full ${getStatusBadgeClass(lesson.status)}`}>
                                                {lesson.status}
                                            </span>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 text-center py-4">No lessons scheduled for today</p>
                            )}
                        </div>
                    </div>
                </div>

                {/* Recent Activity */}
                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Recent Attendance */}
                    <div className="bg-white rounded-lg shadow-md border p-6">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900">📋 Recent Attendance</h3>
                            <Link href="/attendances">
                                <Button variant="outline" size="sm">View All</Button>
                            </Link>
                        </div>
                        
                        <div className="space-y-3">
                            {recentAttendances.map((attendance) => (
                                <div key={attendance.id} className="flex items-center justify-between border-b pb-2">
                                    <div>
                                        <p className="font-medium text-gray-900">{attendance.teacher.full_name}</p>
                                        <p className="text-sm text-gray-600">
                                            {new Date(attendance.date).toLocaleDateString()}
                                        </p>
                                        {attendance.clock_in_time && (
                                            <p className="text-sm text-gray-500">
                                                In: {attendance.clock_in_time}
                                                {attendance.clock_out_time && ` | Out: ${attendance.clock_out_time}`}
                                            </p>
                                        )}
                                    </div>
                                    <span className={`px-2 py-1 text-xs font-medium rounded-full ${getStatusBadgeClass(attendance.status)}`}>
                                        {attendance.status}
                                    </span>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Upcoming Lessons */}
                    <div className="bg-white rounded-lg shadow-md border p-6">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900">🗓️ Upcoming Lessons</h3>
                            <Link href="/lessons">
                                <Button variant="outline" size="sm">View All</Button>
                            </Link>
                        </div>
                        
                        <div className="space-y-3">
                            {upcomingLessons.map((lesson) => (
                                <div key={lesson.id} className="border-b pb-2">
                                    <div className="flex items-center justify-between">
                                        <div>
                                            <p className="font-medium text-gray-900">{lesson.subject}</p>
                                            <p className="text-sm text-gray-600">
                                                {new Date(lesson.lesson_date).toLocaleDateString()} | {lesson.start_time}
                                            </p>
                                            <p className="text-sm text-gray-500">
                                                {lesson.teacher.full_name} | {lesson.classroom}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg border p-6">
                    <h3 className="text-lg font-semibold text-gray-900 mb-4">🚀 Quick Actions</h3>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <Link href="/students">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-xl mb-1">👨‍🎓</span>
                                <span className="text-sm">Manage Students</span>
                            </Button>
                        </Link>
                        <Link href="/teachers">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-xl mb-1">👨‍🏫</span>
                                <span className="text-sm">Manage Teachers</span>
                            </Button>
                        </Link>
                        <Link href="/attendances">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-xl mb-1">📊</span>
                                <span className="text-sm">Attendance</span>
                            </Button>
                        </Link>
                        <Link href="/lessons">
                            <Button variant="outline" className="w-full h-20 flex-col">
                                <span className="text-xl mb-1">📚</span>
                                <span className="text-sm">Lessons</span>
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}