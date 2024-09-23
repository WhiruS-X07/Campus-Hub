<?php
include("header.php");
include("sidebar.php");
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome Back!</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Total Students -->
                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-3">Total Students</p>
                            <p class="fs-30 mb-2">1,234</p>
                            <p>26% (final year students)</p>
                        </div>
                    </div>
                </div>

                <!-- Today's Attendance -->
                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-3">Today's Attendance</p>
                            <p class="fs-30 mb-2">963</p>
                            <p>5.00% (increase from yesterday)</p>
                        </div>
                    </div>
                </div>

                <!-- New Enrollments -->
                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-3">New Enrollments</p>
                            <p class="fs-30 mb-2">345</p>
                            <p>18.00% (increase compared to last Sem)</p>
                        </div>
                    </div>
                </div>

                <!-- Pending Assignments -->
                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card" style="background-color: #9168f7; color: #ffffff;">
                        <div class="card-body">
                            <p class="mb-3">Pending Assignments</p>
                            <p class="fs-30 mb-2">498</p>
                            <p>59.64% (Submitted)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="card-title">Exam Results Report</p>
                            </div>
                            <p class="font-weight-500">This report displays the number of students who passed and those
                                with backlogs for each semester.</p>
                            <div id="studentResultsChart-legend" class="chartjs-legend mt-4 mb-2"></div>
                            <canvas id="studentResultsChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <p class="card-title">Events</p>
                            </div>
                            <p class="font-weight-500">This calendar shows upcoming school events and important dates
                                for students and staff.</p>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">School To-Do List</h4>
                                <div class="list-wrapper pt-2">
                                    <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                        <li>
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> Prepare lesson plans for
                                                    next week
                                                </label>
                                            </div>
                                            <i class="remove ti-close"></i>
                                        </li>
                                        <li class="completed">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox" checked> Grade homework
                                                    submissions
                                                </label>
                                            </div>
                                            <i class="remove ti-close"></i>
                                        </li>
                                        <li>
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> Schedule parent-teacher
                                                    meetings
                                                </label>
                                            </div>
                                            <i class="remove ti-close"></i>
                                        </li>
                                        <li class="completed">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox" checked> Organize school
                                                    event
                                                </label>
                                            </div>
                                            <i class="remove ti-close"></i>
                                        </li>
                                        <li>
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input class="checkbox" type="checkbox"> Review student progress
                                                    reports
                                                </label>
                                            </div>
                                            <i class="remove ti-close"></i>
                                        </li>
                                    </ul>
                                </div>
                                <div class="add-items d-flex mb-0 mt-2">
                                    <input type="text" class="form-control todo-list-input" placeholder="Add new task">
                                    <button class="add btn btn-icon text-primary todo-list-add-btn bg-transparent">
                                        <i class="icon-circle-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-7 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="card-title">Exams List</p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table custom-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Subject</th>
                                                <th>Course</th>
                                                <th>Section</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Biology</td>
                                                <td>B.Sc</td>
                                                <td>A</td>
                                                <td>02.00pm</td>
                                                <td>25/09/2024</td>
                                                <td class="text-right">
                                                    <button type="button" data-toggle="modal" data-target="#delete_exam"
                                                        class="btn btn-danger btn-sm mb-1"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mathematics</td>
                                                <td>MCA</td>
                                                <td>A</td>
                                                <td>11.00am</td>
                                                <td>26/09/2024</td>
                                                <td class="text-right">
                                                    <button type="button" data-toggle="modal" data-target="#delete_exam"
                                                        class="btn btn-danger btn-sm mb-1"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Physics</td>
                                                <td>B.Sc</td>
                                                <td>B</td>
                                                <td>01.00pm</td>
                                                <td>27/09/2024</td>
                                                <td class="text-right">
                                                    <button type="button" data-toggle="modal" data-target="#delete_exam"
                                                        class="btn btn-danger btn-sm mb-1"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>History</td>
                                                <td>BBA</td>
                                                <td>C</td>
                                                <td>09.00am</td>
                                                <td>28/09/2024</td>
                                                <td class="text-right">
                                                    <button type="button" data-toggle="modal" data-target="#delete_exam"
                                                        class="btn btn-danger btn-sm mb-1"><i
                                                            class="far fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <td>Geography</td>
                                            <td>BBA</td>
                                            <td>D</td>
                                            <td>03.00pm</td>
                                            <td>29/09/2024</td>
                                            <td class="text-right">
                                                <button type="button" data-toggle="modal" data-target="#delete_exam"
                                                    class="btn btn-danger btn-sm mb-1"><i
                                                        class="far fa-trash-alt"></i></button>
                                            </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>