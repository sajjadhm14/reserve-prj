@extends('user.dashboard')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Consultants List</h4>

                        <div class="d-flex flex-column gap-3">
                            {{-- Consultant Card --}}
                            @foreach($consulters as $key=>$consulter)
                            <div class="card shadow-sm w-100">
                                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                    <div>
                                        <h5 class="card-title mb-4">{{$consulter->name}}</h5>
                                        <p class="card-text text-muted mb-2">
                                            {{$consulter->specialization}}
                                        </p>
                                    </div>
                                    <div class="mt-3 mt-md-0">
                                        <a href="#" class="btn btn-primary px-4 py-2 fw-bold btn-reserve"
                                           data-id="1" style="font-size: 15px;">Reserve</a>
                                    </div>
                                </div>
                            </div> @endforeach



                            {{-- /Consultant Card --}}
                        </div>

                        <!-- Reservation Modal -->
                        <div class="modal fade" id="reservationModal" tabindex="-1"
                             aria-labelledby="reservationModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reservationModalLabel">Reserve Consultant</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">Select Date</label>
                                        <input type="text" id="reservation-date" class="form-control mb-3" placeholder="Choose a date">

                                        <label class="form-label">Select Time</label>
                                        <input type="text" id="reservation-time" class="form-control" placeholder="Choose a time">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="button" id="confirmReservation" class="btn btn-primary">Confirm
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Reservation Modal -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script --}}
    <script>
        $(document).ready(function () {

            // Initialize date picker
            $('#reservation-date').flatpickr({
                minDate: "today",
                dateFormat: "Y-m-d"
            });

            // Initialize time picker
            $('#reservation-time').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i", // 24-hour format like 13:30
                time_24hr: true
            });

            // Handle Reserve button click
            $(document).on('click', '.btn-reserve', function (e) {
                e.preventDefault();

                let consulterId = $(this).data('id');
                let consulterName = $(this).closest('.card-body').find('.card-title').text();

                $('#reservationModalLabel').text('Reserve: ' + consulterName);
                $('#reservationModal').data('consulter_id', consulterId);
                $('#reservationModal').modal('show');
            });

            // Handle Confirm Reservation button
            $('#confirmReservation').on('click', function () {
                let date = $('#reservation-date').val();
                let time = $('#reservation-time').val();
                let consulterId = $('#reservationModal').data('consulter_id');

                if (!date || !time) {
                    toastr.warning('Please select both date and time.');
                    return;
                }

                $.ajax({
                    url: "{{ route('reservation.store') }}",
                    method: "POST",
                    data: {
                        date: date,
                        time: time,
                        consulter_id: consulterId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        toastr.success(response.message);
                        $('#reservationModal').modal('hide');
                    },
                    error: function (xhr) {
                        if (xhr.status === 409) {
                            toastr.error(xhr.responseJSON.error);
                        } else {
                            toastr.error('Something went wrong!');
                        }
                    }
                });
            });

        });

    </script>
@endsection
