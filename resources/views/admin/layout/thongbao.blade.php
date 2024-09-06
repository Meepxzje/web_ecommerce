@if(session('suc'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ session('suc') }}",
            showConfirmButton: false,
        });
    </script>
@endif

@if(session('err'))
    <script>
        Swal.fire({
            icon: 'error',
            title: "{{ session('err') }}",
            showConfirmButton: false,
        });
    </script>
@endif

