@if (session('success'))
<script>
    toastr.success('{{ session('success') }}', 'Success !')
</script>
@endif