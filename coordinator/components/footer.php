<!--start footer-->
<footer class="footer mt-auto footer-light">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 small">Copyright &#xA9; Capstone Project <script>
                    document.write(new Date().getFullYear());
                </script>
            </div>
        </div>
    </div>
</footer>
<!--end footer-->
</div>
</div>

<!--Script JS-->
<script src="../assets/js/jquery-3.4.1.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/scripts.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        $('#dataTable_Attendance').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
</body>

</html>