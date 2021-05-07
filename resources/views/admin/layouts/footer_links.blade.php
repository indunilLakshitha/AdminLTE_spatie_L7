<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Follow The Doc
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 <a href="https://soala.lk">Soala.lk</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>

{{-- <!-- SweetAlert2 -->
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('admin/plugins/toastr/toastr.min.js')}}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script type="text/javascript">
    function alerts(){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

        Toast.fire({
          icon: 'success',
          title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      });
    }

    function remove(id,url){
        //  console.log(id,url);

         Swal.fire({
            title: 'Do you want to Delete ?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            })
            .then((result) => {
              if (result.value) {
                $.ajax({
                        type:'POST',
                        url:url,
                        data:{
                            "_token": "{{ csrf_token() }}",
                            id: id,
                        },
                        success:function(data){

                            location.reload();

                        }

                    });
              }

            })

    }
    function block(id,url){
        //  console.log(id,url);

         Swal.fire({
            title: 'Do you want to Block ?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            })
            .then((result) => {
              if (result.value) {
                $.ajax({
                        type:'POST',
                        url:url,
                        data:{
                            "_token": "{{ csrf_token() }}",
                            id: id,
                        },
                        success:function(data){

                            location.reload();

                        }

                    });
              }

            })

    }


</script>

</body>

</html>
