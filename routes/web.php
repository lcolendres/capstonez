<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\ChairpersonController;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DeanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Authentication Routes
Route::middleware(['guest'])->get('/', [TrackerController::class, 'landing_page'])->name('tracker.landing_page');
Route::middleware(['guest'])->get('/get_status/{code}', [TrackerController::class, 'get_accredited_subjects'])->name('tracker.get_accredited_subjects');
Route::middleware(['guest'])->get('/generate_pdf/{code}', [TrackerController::class, 'generate_pdf'])->name('tracker.generate_pdf');
Route::middleware(['guest'])->get('/login', [AuthenticationController::class, 'login_view'])->name('login.view');
Route::middleware(['guest'])->post('/login', [AuthenticationController::class, 'login_authenticate'])->name('login.authenticate');
Route::middleware(['auth'])->get('/change-password', [AuthenticationController::class, 'change_password'])->name('auth.change_password');
Route::middleware(['auth'])->post('/change-password', [AuthenticationController::class, 'save_change_password'])->name('auth.save_change_password');
Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

// Admission Routes
Route::middleware(['auth', 'checkRoles:1'])->prefix('admission')->group(function() {
    // Dashboard
    Route::get('', [AdmissionController::class, 'dashboard'])->name('admission.dashboard');
    Route::get('/get_history', [AdmissionController::class, 'get_history'])->name('admission.get_history');

    // Student
    Route::get('/students', [AdmissionController::class, 'students_view'])->name('admission.students_view');
    Route::get('/students/list', [AdmissionController::class, 'get_student'])->name('admission.get_student');
    Route::get('/add_student', [AdmissionController::class, 'add_student_view'])->name('admission.add_student_view');
    Route::post('/add_student', [AdmissionController::class, 'add_student'])->name('admission.add_student');
    Route::delete('/student/{id}', [AdmissionController::class, 'delete_student'])->name('admission.delete_student');
    Route::get('/student/{id}', [AdmissionController::class, 'edit_student'])->name('admission.edit_student_view');
    Route::post('/student/{id}/edit', [AdmissionController::class, 'save_student_changes'])->name('admission.save_student_changes');
    Route::get('/student/{id}/details', [AdmissionController::class, 'student_details'])->name('admission.student_details');
    Route::post('/save_tor', [AdmissionController::class, 'save_tor'])->name('admission.save_tor');
    Route::get('/get_tors/{id}', [AdmissionController::class, 'get_tors'])->name('admission.get_tors');
    Route::delete('/tor/{id}', [AdmissionController::class, 'delete_tor'])->name('admission.delete_tor');
    Route::get('/tor/{student_id}/{tor_id}', [AdmissionController::class, 'map_data'])->name('admission.map_data');
    Route::get('/subjects_for_credit/{student_id}', [AdmissionController::class, 'get_subject_for_credit'])->name('admission.get_subject_for_credit');
});

// Program Chairperson Routes
Route::middleware(['auth', 'checkRoles:2'])->prefix('chairperson')->group(function() {
    Route::get('', [ChairpersonController::class, 'dashboard'])->name('chairperson.dashboard');
    Route::get('/students', [ChairpersonController::class, 'get_students'])->name('chairperson.get_students');
    Route::get('/student/{student_id}', [ChairpersonController::class, 'get_student'])->name('chairperson.get_student');
    Route::get('/student/{student_id}/subjects', [ChairpersonController::class, 'get_subjects_for_accreditation'])->name('chairperson.get_subjects_for_accreditation');
    Route::put('/accredit/{accreditation_id}/{status}', [ChairpersonController::class, 'update_status'])->name('chairperson.update_status');
    Route::get('/upload_esig/{user_id}', [ChairpersonController::class, 'upload_esig'])->name('chairperson.upload_esig');
    Route::post('/upload_esig/{user_id}', [ChairpersonController::class, 'save_upload_esig'])->name('chairperson.save_upload_esig');
    Route::get('/validate', [ChairpersonController::class, 'validate_student'])->name('chairperson.validate_student');
    Route::get('/student_for_validation', [ChairpersonController::class, 'recommend'])->name('chairperson.recommend');
    Route::get('/generate_pdf/{code_id}', [ChairpersonController::class, 'generate_pdf'])->name('chairperson.generate_pdf');
    Route::post('/update_recommend_approval/{student_id}/{code_id}', [ChairpersonController::class, 'update_recommend_approval'])->name('chairperson.update_recommend_approval');
    Route::get('/get_history', [ChairpersonController::class, 'get_history'])->name('chairperson.get_history');
});

// Superadmin
Route::middleware(['auth', 'checkRoles:0'])->prefix('superadmin')->group(function() {
    Route::get('', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');

    // Users
    Route::get('/get_users', [SuperAdminController::class, 'get_users'])->name('superadmin.get_users');
    Route::post('/add_user', [SuperAdminController::class, 'add_user'])->name('superadmin.add_user');
    Route::get('/user/{user_id}', [SuperAdminController::class, 'get_user'])->name('superadmin.get_user');
    Route::post('/user/{user_id}/edit', [SuperAdminController::class, 'edit_user'])->name('superadmin.edit_user');
    Route::delete('/user/{user_id}', [SuperAdminController::class, 'delete_user'])->name('superadmin.delete_user');

    // Course
    Route::get('/courses', [SuperAdminController::class, 'courses'])->name('superadmin.courses_view');
    Route::get('/course_list', [SuperAdminController::class, 'courses_table'])->name('superadmin.course_list');
    Route::post('/courses', [SuperAdminController::class, 'save_course'])->name('superadmin.save_course');
    Route::get('/course/{id}', [SuperAdminController::class, 'course_detail'])->name('superadmin.course_detail');
    Route::get('/courses/{id}', [SuperAdminController::class, 'get_course'])->name('superadmin.get_course');
    Route::post('/courses/{id}/edit', [SuperAdminController::class, 'update_course'])->name('superadmin.update_course');
    Route::delete('/courses/{id}', [SuperAdminController::class, 'delete_course'])->name('superadmin.delete_course');

    // Subject
    Route::get('/subjects/{id}', [SuperAdminController::class, 'get_subjects'])->name('superadmin.get_subjects');
    Route::post('/subjects', [SuperAdminController::class, 'save_subject'])->name('superadmin.save_subject');
    Route::get('/subject/{id}', [SuperAdminController::class, 'get_subject'])->name('superadmin.get_subject');
    Route::post('/subject/{id}/edit', [SuperAdminController::class, 'update_subject'])->name('superadmin.update_subject');
    Route::delete('/subject/{id}', [SuperAdminController::class, 'delete_subject'])->name('superadmin.delete_subject');
});

// Dean
Route::middleware(['auth', 'checkRoles:3'])->prefix('dean')->group(function() {
    Route::get('/', [DeanController::class, 'dashboard'])->name('dean.dashboard');
    Route::get('/for_approval_list', [DeanController::class, 'for_approval_list'])->name('dean.for_approval_list');
    Route::get('/upload_esig/{user_id}', [DeanController::class, 'upload_esig'])->name('dean.upload_esig');
    Route::post('/upload_esig/{user_id}', [DeanController::class, 'save_upload_esig'])->name('dean.save_upload_esig');
    Route::get('/generate_pdf/{code_id}', [DeanController::class, 'generate_pdf'])->name('dean.generate_pdf');
    Route::post('/approved/{student_id}/{code_id}', [DeanController::class, 'approved'])->name('dean.approved');
});