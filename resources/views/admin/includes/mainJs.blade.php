<script src="{{ asset('backend/assets/js/main.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/dropify.min.js') }}"></script>


<script>
    $('.select2').select2();
</script>
<script>
    $('.reset').click(function() {
        $('#rolode').load(' #rolode')
    });

    function sweetAlertDelete(id) {
        event.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Information!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! Your data has been deleted!", {
                        icon: "success",
                        buttons: false,
                        timer: 2000
                    });
                    $("#deleteButton" + id).submit();
                } else {
                    swal("Your data is safe!");
                }
            });
    }
    function sweetAlertApprove(id) {
        event.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Wants to approve this user to login your system!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! The requested user approve by you!", {
                        icon: "success",
                        buttons: false,
                        timer: 2000
                    });
                    $("#successApprove" + id).submit();
                } else {
                    swal("Requested user not approve!");
                }
            });
    }
    function sweetAlertBlock(id) {
        event.preventDefault();
        swal({
                title: "Are you sure?",
                text: "Wants to block this user to prevent login from your system!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Poof! This user is block by you!", {
                        icon: "success",
                        buttons: false,
                        timer: 2000
                    });
                    $("#successBlock" + id).submit();
                } else {
                    swal("This user in not block!");
                }
            });
    }
</script>
<script>
    $('.dropify').dropify();
</script>
{{-- <script>
    $(document).ready(function() {
      $('#common_table').DataTable({
          dom: 'Bfrtip',
          buttons: [
              'copy', 'excel', 'pdf', 'csv'
          ]
      });
    });
  </script> --}}
