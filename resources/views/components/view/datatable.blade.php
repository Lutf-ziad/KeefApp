@push('js')
    <script src="{{ asset('storage/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('storage/assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#my-data-table').DataTable({
                dom: "Blfrtip",
                "ordering": true,
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "info": false,
                stateSave: true
            });
        });
    </script>
@endpush
