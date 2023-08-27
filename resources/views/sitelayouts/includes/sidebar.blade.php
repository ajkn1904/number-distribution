<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{url('/dashboard')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages"
                    aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <!-- <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div> -->
                </a>
                <div>
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <!-- <a class="nav-link" href="{{url('/login')}}">Login</a>
                                <a class="nav-link" href="{{url('/registration')}}">Register</a> -->
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>

                        @if(Session::has('user_role') && Session::get('user_role')=='SuperAdmin')
                        <!-- department -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseDepartments" aria-expanded="false"
                            aria-controls="pagesCollapseDepartments">
                            Departments
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseDepartments" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link" href="{{url('/department/create')}}">Create</a>
                                <a class="nav-link" href="{{url('/department/all')}}">Alls</a>

                            </nav>
                        </div>


                        <!-- teachers & admin -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseTeachers" aria-expanded="false"
                            aria-controls="pagesCollapseTeachers">
                            Teachers
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseTeachers" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link" href="{{url('/teacher/all_teachers')}}">All</a>
                                <a class="nav-link" href="{{url('/teacher/create')}}">Create</a>

                            </nav>
                        </div>

                        <!-- students -->

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseStudents" aria-expanded="false"
                            aria-controls="pagesCollapseStudents">
                            Students
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseStudents" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">


                                <a class="nav-link" href="{{url('/student/all_students')}}">All</a>
                                <a class="nav-link" href="{{url('/student/create')}}">Create</a>


                            </nav>
                        </div>

                        @endif




                        @if(Session::has('user_role') && (Session::get('user_role') == 'Admin'))
                        <!-- teachers & admin -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseTeachers" aria-expanded="false"
                            aria-controls="pagesCollapseTeachers">
                            Teachers
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseTeachers" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">

                                <a class="nav-link" href="{{url('/teacher/all-department-teachers')}}">All</a>
                                <a class="nav-link" href="{{url('/teacher/department-create')}}">Create</a>

                            </nav>
                        </div>

                        <!-- students -->

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseStudents" aria-expanded="false"
                            aria-controls="pagesCollapseStudents">
                            Students
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseStudents" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">


                                <a class="nav-link" href="{{url('/student/all-department-students')}}">All</a>
                                <a class="nav-link" href="{{url('/student/department-create')}}">Create</a>


                            </nav>
                        </div>

                        <!-- courses -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseCourses" aria-expanded="false"
                            aria-controls="pagesCollapseCourses">
                            Courses
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseCourses" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">


                                <a class="nav-link" href="{{url('/courses/all-courses')}}">All</a>
                                <a class="nav-link" href="{{url('/courses/create')}}">Create</a>


                            </nav>
                        </div>


                        <!-- session -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseSession" aria-expanded="false"
                            aria-controls="pagesCollapseSession">
                            Session
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseSession" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">


                                <a class="nav-link" href="{{url('/session/all-session')}}">All</a>
                                <a class="nav-link" href="{{url('/session/create')}}">Create</a>


                            </nav>
                        </div>

                        @endif


                        <!--  <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseUserWisePages" aria-expanded="false"
                            aria-controls="pagesCollapseUserWisePages">
                            Other Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseUserWisePages" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">

                                @if(Session::has('user_role') && Session::get('user_role')=='SuperAdmin')
                                <a class="nav-link" href="{{url('/pending-users')}}">Pending</a>
                                @endif


                                <a class="nav-link" href="{{url('')}}">Courses</a>

                            </nav>
                        </div> -->


                        <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#pagesCollapseError" aria-expanded="false"
                            aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div> -->
                    </nav>
                </div>
                <!--  <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="{{url('super-admin/tables')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a> -->
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>