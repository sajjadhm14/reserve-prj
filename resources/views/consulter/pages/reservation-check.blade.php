@extends('consulter.consulter-dashboard')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">My Reservations</h4>

                        {{-- Info message if no reservations exist --}}
                        @if($reservations->isEmpty())
                            <div class="alert alert-info text-center">
                                No reservations have been scheduled yet.
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reservations as $key => $reservation)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $reservation->user->name ?? 'N/A' }}</td>
                                            <td>{{ $reservation->date }}</td>
                                            <td>{{ $reservation->time }}</td>
                                            <td>
                                                    <span class="badge bg-{{ $reservation->status == 'pending' ? 'warning' : 'success' }}">
                                                        {{ ucfirst($reservation->status) }}
                                                    </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
