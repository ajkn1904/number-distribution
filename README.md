<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About The Project

Currently, the number distribution is fixed for theory/lab courses. The aim of this project
is to make it dynamic.
- Admin will create courses, teachers, sections, and session etc
- Teacher, after being assigned to a particular course, can fix the mark distribution
- Marks will be given accordingly
- Results will be calculated accordingly


--- 


# Project Details

---

### User Management/Registration/Login
- There will be 4 types of users: Super Admin, Department Admin, Teacher, Student
- Students and Teachers will be registered
- Super Admin user will be manually added (using query or interface) to the system
- If admin creates teachers and students, then they will be automatically approved. But if
the students and teachers are registered by themselves, then approval from Admin is
required
- Admin can also create other users with Admin role
- The system will have a single login page. Once login, the information of the logged-in
user will be saved in the session### User Management/Registration/Login
- There will be 4 types of users: Super Admin, Department Admin, Teacher, Student
- Students and Teachers will be registered
- Super Admin user will be manually added (using query or interface) to the system
- If admin creates teachers and students, then they will be automatically approved. But if
the students and teachers are registered by themselves, then approval from Admin is
required
- Admin can also create other users with Admin role
- The system will have a single login page. Once login, the information of the logged-in
user will be saved in the session

### Security
- Each type of user will perform separate activities. So proper authorization should be
maintained according to the user’s role
- Password should be encrypted. Software should not contain duplicate values for the email
or user id/roll/phone number etc.

### Functionalities of Super Admin
- Will create departments
- Will create admin user for each department
- Can create students and teachers for departments

### Functionalities of Admin (Department)
- Create both students and teachers
- CRUD courses, CRUD session. Also, can change the status of session
- For a session, will create the offers (create section/sections for course and assign
teachers)


### Functionalities of Student
- Can register to the system
- Will enroll the courses to a specific section for a specific session
- Can submit the group members information and details of project idea
- View the status of the project idea. If modification needed, will edit the idea and resubmit
it

### Functionalities of Course Teacher
- Will view the running courses (session wise)
- Will change/fix/create the distribution of course
- All the students under that course will be given marks according to the number
distribution
