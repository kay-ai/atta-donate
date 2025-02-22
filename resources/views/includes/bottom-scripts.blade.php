<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Include SweetAlert CDN -->
<script src="{{asset('/assets/sweetalert/sweetalert.min.js')}}"></script>
<!-- Include Paystack CDN -->
<script src="https://js.paystack.co/v1/inline.js"></script>
<!-- Include custom JavaScript file -->
<script src="{{asset('/js/script.js')}}"></script>
<script src="{{asset('/js/paystack.js')}}"></script>

<script>
    $(document).ready(function () {
        // Toggle sidebar visibility on button click (only on mobile)
        $('#sidebarToggle').click(function () {
            $('.sidebar').toggleClass('open');
            $('.main-content').toggleClass('open');  // Adjust main content on toggle
        });

        // Close sidebar when clicking outside of it
        $(document).click(function (event) {
            if (!$(event.target).closest('.sidebar, #sidebarToggle').length) {
                $('.sidebar').removeClass('open');
                $('.main-content').removeClass('open');  // Reset main content on close
            }
        });
    });
</script>
    <!-- jQuery & DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.data-table').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "dom": 'Bfrtip', // Enable buttons
                "buttons": [
                    {
                        extend: 'copy',
                        text: 'Copy',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'csv',
                        text: 'CSV',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'colvis',
                        text: 'Column Visibility',
                        className: 'btn btn-dark'
                    }
                ]
            });
        });
    </script>
@stack('js')
