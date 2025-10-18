@extends('consulter.consulter-dashboard')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">My Reservations</h4>

                        {{-- Info message if no reservations exist --}}
                        <div class="alert alert-info text-center">
                            No reservations have been scheduled yet.
                        </div>

                        {{-- Table structure (you will fill data later) --}}
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>rows</th>
                                    <th>User Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                                    <td>2025-10-20</td>
                                    <td>14:00 - 14:30</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>2025-10-22</td>
                                    <td>16:00 - 16:30</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Ali Reza</td>
                                    <td>2025-10-25</td>
                                    <td>11:30 - 12:00</td>
                                    <td><span class="badge bg-danger">Cancelled</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

