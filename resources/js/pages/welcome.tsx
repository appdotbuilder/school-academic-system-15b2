import React from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

export default function Welcome() {
    return (
        <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
            {/* Navigation */}
            <nav className="bg-white shadow-sm border-b">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between items-center py-4">
                        <div className="flex items-center space-x-3">
                            <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span className="text-white font-bold text-lg">🏫</span>
                            </div>
                            <h1 className="text-xl font-bold text-gray-900">EduTrack</h1>
                        </div>
                        <div className="flex items-center space-x-3">
                            <Link href="/login">
                                <Button variant="outline">Login</Button>
                            </Link>
                            <Link href="/register">
                                <Button>Register</Button>
                            </Link>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Hero Section */}
            <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
                <div className="text-center">
                    <h1 className="text-5xl font-bold text-gray-900 mb-6">
                        🎓 School Academic Information System
                    </h1>
                    <p className="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        Streamline your educational institution with comprehensive management tools for teachers, staff, and administrators. Manage attendance, schedules, and academic data all in one place.
                    </p>
                    
                    <div className="flex justify-center space-x-4 mb-16">
                        <Link href="/register">
                            <Button size="lg" className="px-8 py-3">
                                Get Started Today 🚀
                            </Button>
                        </Link>
                        <Link href="/login">
                            <Button variant="outline" size="lg" className="px-8 py-3">
                                Staff Login
                            </Button>
                        </Link>
                    </div>
                </div>

                {/* Feature Grid */}
                <div className="grid md:grid-cols-3 gap-8 mb-16">
                    {/* Teacher Attendance */}
                    <div className="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                        <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span className="text-3xl">👨‍🏫</span>
                        </div>
                        <h3 className="text-xl font-semibold text-gray-900 mb-3">Teacher Attendance</h3>
                        <p className="text-gray-600 leading-relaxed">
                            Track and manage teacher attendance with digital clock-in/out, leave requests, and comprehensive reporting tools.
                        </p>
                    </div>

                    {/* Data Management */}
                    <div className="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                        <div className="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span className="text-3xl">📊</span>
                        </div>
                        <h3 className="text-xl font-semibold text-gray-900 mb-3">Data Management</h3>
                        <p className="text-gray-600 leading-relaxed">
                            Complete student, teacher, and staff records management with secure data storage and easy access controls.
                        </p>
                    </div>

                    {/* Lesson Scheduling */}
                    <div className="bg-white rounded-lg shadow-md p-8 text-center hover:shadow-lg transition-shadow">
                        <div className="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span className="text-3xl">📅</span>
                        </div>
                        <h3 className="text-xl font-semibold text-gray-900 mb-3">Lesson Scheduling</h3>
                        <p className="text-gray-600 leading-relaxed">
                            Create and manage lesson schedules, assign teachers, track curriculum progress, and coordinate resources.
                        </p>
                    </div>
                </div>

                {/* School Promotions Section */}
                <div className="bg-white rounded-lg shadow-lg p-8 mb-16">
                    <h2 className="text-3xl font-bold text-center text-gray-900 mb-8">
                        🌟 School Highlights & Achievements
                    </h2>
                    
                    <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div className="text-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg">
                            <div className="text-2xl mb-2">🏆</div>
                            <div className="text-2xl font-bold text-blue-600">98%</div>
                            <div className="text-sm text-gray-600">Teacher Satisfaction</div>
                        </div>
                        
                        <div className="text-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-lg">
                            <div className="text-2xl mb-2">📈</div>
                            <div className="text-2xl font-bold text-green-600">500+</div>
                            <div className="text-sm text-gray-600">Students Managed</div>
                        </div>
                        
                        <div className="text-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg">
                            <div className="text-2xl mb-2">⏰</div>
                            <div className="text-2xl font-bold text-purple-600">99.5%</div>
                            <div className="text-sm text-gray-600">System Uptime</div>
                        </div>
                        
                        <div className="text-center p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg">
                            <div className="text-2xl mb-2">🎯</div>
                            <div className="text-2xl font-bold text-orange-600">24/7</div>
                            <div className="text-sm text-gray-600">Support Available</div>
                        </div>
                    </div>
                </div>

                {/* Benefits Section */}
                <div className="text-center">
                    <h2 className="text-3xl font-bold text-gray-900 mb-8">
                        Why Choose EduTrack? 🤔
                    </h2>
                    
                    <div className="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                        <div className="flex items-start space-x-4 text-left">
                            <div className="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span className="text-green-600">✓</span>
                            </div>
                            <div>
                                <h4 className="font-semibold text-gray-900 mb-2">Streamlined Operations</h4>
                                <p className="text-gray-600">Reduce administrative overhead with automated attendance tracking and scheduling.</p>
                            </div>
                        </div>
                        
                        <div className="flex items-start space-x-4 text-left">
                            <div className="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span className="text-green-600">✓</span>
                            </div>
                            <div>
                                <h4 className="font-semibold text-gray-900 mb-2">Secure Data Management</h4>
                                <p className="text-gray-600">Keep sensitive academic information protected with enterprise-grade security.</p>
                            </div>
                        </div>
                        
                        <div className="flex items-start space-x-4 text-left">
                            <div className="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span className="text-green-600">✓</span>
                            </div>
                            <div>
                                <h4 className="font-semibold text-gray-900 mb-2">Real-time Reporting</h4>
                                <p className="text-gray-600">Access comprehensive reports and analytics to make informed decisions.</p>
                            </div>
                        </div>
                        
                        <div className="flex items-start space-x-4 text-left">
                            <div className="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <span className="text-green-600">✓</span>
                            </div>
                            <div>
                                <h4 className="font-semibold text-gray-900 mb-2">Easy Integration</h4>
                                <p className="text-gray-600">Seamlessly integrate with existing school systems and workflows.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Footer */}
            <footer className="bg-gray-800 text-white py-8">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <p className="text-gray-300">
                        © 2024 EduTrack - School Academic Information System. All rights reserved.
                    </p>
                    <p className="text-sm text-gray-400 mt-2">
                        Empowering education through technology 🚀
                    </p>
                </div>
            </footer>
        </div>
    );
}