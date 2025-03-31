@extends('layouts.app')

@push('css')
<style>
    .modal {
        z-index: 1050 !important;
    }

    .modal-backdrop {
        z-index: 1000 !important;
    }
</style>
@endpush
@section('content')
<div class="container">
    <h2 class="mb-4">Scheduled Interviews</h2>
    <div id="calendar"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="interviewModal" tabindex="-1" aria-labelledby="interviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="interviewModalLabel">Interview Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Applicant:</strong> <span id="modalTitle"></span></p>
                <p><strong>Date:</strong> <span id="modalDate"></span></p>
                <p><strong>Time:</strong> <span id="modalTime"></span></p>
                <p><strong>Venue:</strong> <span id="modalVenue"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: @json($interviews), // Events from the controller
        eventClick: function(info) {
            $('.modal-backdrop').remove();
            // Set modal content
            $('#modalTitle').text(info.event.title);
            $('#modalDate').text(info.event.start.toISOString().split('T')[0]);
            $('#modalTime').text(info.event.start.toISOString().split('T')[1].substr(0, 5));
            $('#modalVenue').text(info.event.extendedProps.description.replace("Venue: ", ""));

            // Show modal
            $('#interviewModal').modal('show');
        }
    });

    calendar.render();
});
</script>
@endpush