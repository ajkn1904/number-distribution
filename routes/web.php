<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLayoutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentSessionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\TheSectionController;

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', [AdminLayoutController::class, 'dashboard']);
//Route::get('/tables', [AdminLayoutController::class, 'tables']);



//login & registration-------------------------

Route::get('/login', [AuthController::class, 'login']);
Route::post('/user-login', [AuthController::class, 'userLogin']);
/* Route::get('/registration', [AdminLayoutController::class, 'registration']); */

Route::get('/teacher-register', [AuthController::class, 'teacherRegister']);
Route::post('/teacher-registration', [AuthController::class, 'registrationTeacher']);

Route::get('/student-register', [AuthController::class, 'studentRegister']);
Route::post('/student-registration', [AuthController::class, 'registrationStudent']);



//middleware to make routes protected
Route::middleware(['checkLogin'])->group(function () {

    Route::get('/dashboard', [AdminLayoutController::class, 'dashboard']);
    Route::get('/tables', [AdminLayoutController::class, 'tables']);

    Route::get('/logout', [AuthController::class,'logout']);
    //Route::get('/pending-users', [UserController::class, 'pendingUsers']);


    Route::middleware(['checkIfSuperAdminOrAdmin'])->group(function () {

    });


    Route::middleware(['checkIfAdmin'])->group(function () {
        //teacher
        Route::get('/teacher/department-create', [AuthController::class, 'createDepartmentTeacher']);
        Route::post('/teacher/department-creation', [AuthController::class, 'teacherDepartmentCreate']);

        Route::get('/teacher/all-department-teachers', [UserController::class, 'allDepartmentTeacher']);



        //student
        Route::get('/student/department-create', [AuthController::class, 'createDepartmentStudent']);
        Route::post('/student/department-creation', [AuthController::class, 'studentDepartmentCreate']);
        Route::get('/student/all-department-students', [UserController::class, 'allDepartmentStudents']);


        //course
        Route::get('/courses/create', [CourseController::class, 'createCourses']);
        Route::post('/courses/creation', [CourseController::class, 'coursesCreate']);
        Route::get('/courses/all-courses', [CourseController::class, 'allCourses']);
        //update course
        Route::get('/courses/edit/{id}', [CourseController::class, 'edit']);
        Route::post('/courses/update/{id}', [CourseController::class, 'update']);

        //delete course
        Route::get('/courses/delete/{id}', [CourseController::class, 'courseDelete']);

        //session
        Route::get('/session/create', [DepartmentSessionController::class, 'createSessions']);
        Route::post('/session/creation', [DepartmentSessionController::class, 'sessionsCreate']);
        Route::get('/session/all-session', [DepartmentSessionController::class, 'allSessions']);
        //update session
        Route::get('/session/edit/{id}', [DepartmentSessionController::class, 'edit']);
        Route::post('/session/update/{id}', [DepartmentSessionController::class, 'update']);

        //update status
        Route::get('/session/expire/{id}', [DepartmentSessionController::class, 'expire']);
        Route::get('/session/running/{id}', [DepartmentSessionController::class, 'running']);

        //delete session
        Route::get('/session/delete/{id}', [DepartmentSessionController::class, 'sessionDelete']);



        //section
        Route::get('/section/create', [TheSectionController::class, 'createSection']);
        Route::post('/section/creation', [TheSectionController::class, 'sectionCreate']);
        Route::get('/section/all-section', [TheSectionController::class, 'allSection']);

        //assign teacher
        Route::get('/section/assign/{id}', [TheSectionController::class, 'assignTeacher']);
        Route::post('/section/update/{id}', [TheSectionController::class, 'courseTeacher']);


        //delete section
        Route::get('/section/delete/{id}', [TheSectionController::class, 'sectionDelete']);

    });


    Route::middleware(['checkIfSuperAdmin'])->group(function () {

        Route::get('/pending-users', [UserController::class, 'pendingUsers']);
        Route::get('/approve-user/{userid}', [UserController::class, 'approveUser']);


        //department
        Route::get('/department/create', [DepartmentController::class, 'create']);

        //post request tor store data to the database
        Route::post('/department/store', [DepartmentController::class, 'store']);
        Route::get('/department/all', [DepartmentController::class, 'all']);

        //teacher
        Route::get('/teacher/create', [AuthController::class, 'createTeacher']);
        Route::post('/teacher/creation', [AuthController::class, 'teacherCreate']);

        Route::get('/teacher/all_teachers', [UserController::class, 'allTeacher']);

        Route::get('/make-admin/{userid}', [UserController::class, 'makeAdmin']);



        //student
        Route::get('/student/create', [AuthController::class, 'createStudent']);
        Route::post('/student/creation', [AuthController::class, 'studentCreate']);
        Route::get('/student/all_students', [UserController::class, 'allStudents']);
    });



    Route::middleware(['checkIfStudent'])->group(function () {
        //department
        Route::get('/enrollment/create', [EnrollmentController::class, 'create']);
        Route::get('/my-courses', [EnrollmentController::class, 'myCourses']);
        Route::get('/enrollment/create/course', [EnrollmentController::class, 'enrollCourse']);
        Route::get('/enrollment/create/course/{id}', [EnrollmentController::class, 'store']);

        Route::get('/enrollment/drop/course/{id}', [EnrollmentController::class, 'delete']);

    });



});
