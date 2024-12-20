<script src="{{ asset('/js/home/toast.js') }}"></script>

<script>
    var baseUrl = "{{ url('/') }}";
</script>
<script src="{{ asset('/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap/sb-admin-2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="{{ asset('/js/admin/easion.js') }}"></script>
<script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
@if (isset($js_files))
    @foreach ($js_files as $js)
        <script src="{{ asset("$js") }}"></script>
    @endforeach
@endif
