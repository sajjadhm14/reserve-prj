@extends('admin.dashboard')

@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-4">Consultants List</h4>

                        <div class="d-flex flex-column gap-3">
                            {{-- Consultant Card --}}
                            <div class="card shadow-sm w-100">
                                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                    <div>
                                        <h5 class="card-title mb-4">{{$consultant->name}}</h5>
                                        <p class="card-text text-muted mb-2">
                                            {{$consultant->specialization}}
                                        </p>
                                    </div>
                                    <div class="mt-3 mt-md-0">
                                        <a href="#" class="btn btn-primary px-4 py-2 fw-bold btn-reserve"
                                           data-id="1" style="font-size: 15px;">Reserve</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm w-100">
                                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                    <div>
                                        <h5 class="card-title mb-4">Consultant 2</h5>
                                        <p class="card-text text-muted mb-2">
                                            Short description about consultant 2 goes here...
                                        </p>
                                    </div>
                                    <div class="mt-3 mt-md-0">
                                        <a href="#" class="btn btn-primary px-4 py-2 fw-bold btn-reserve"
                                           data-id="2" style="font-size: 15px;">Reserve</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm w-100">
                                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                    <div>
                                        <h5 class="card-title mb-4">Consultant 3</h5>
                                        <p class="card-text text-muted mb-2">
                                            Short description about consultant 3 goes here...
                                        </p>
                                    </div>
                                    <div class="mt-3 mt-md-0">
                                        <a href="#" class="btn btn-primary px-4 py-2 fw-bold btn-reserve"
                                           data-id="3" style="font-size: 15px;">Reserve</a>
                                    </div>
                                </div>
                            </div>
                            {{-- /Consultant Card --}}
                        </div>

                        <!-- Reservation Modal -->
                        <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reservationModalLabel">Reserve Consultant</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">Select Date</label>
                                        <input type="text" id="reservation-date" class="form-control" placeholder="Choose a date">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" id="confirmReservation" class="btn btn-primary">Confirm</button>
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

            // Handle Reserve button click
            $(document).on('click', '.btn-reserve', function (e) {
                e.preventDefault();

                let consultantId = $(this).data('id');
                let consultantName = $(this).closest('.card-body').find('.card-title').text();

                $('#reservationModalLabel').text('Reserve: ' + consultantName);
                $('#reservationModal').data('consultant-id', consultantId);
                $('#reservationModal').modal('show');
            });

            // Handle Confirm Reservation button
            $('#confirmReservation').on('click', function () {
                let date = $('#reservation-date').val();
                let consultantId = $('#reservationModal').data('consultant-id');

                if (!date) {
                    toastr.warning('Please select a date first.');
                    return;
                }

                $.ajax({
                    url: "{{ route('reservation.store') }}", // make sure this route exists
                    method: "POST",
                    data: {
                        date: date,
                        consultant_id: consultantId,
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
