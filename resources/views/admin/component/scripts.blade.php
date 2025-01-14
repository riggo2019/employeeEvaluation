<script src="{{ asset('/js/home/toast.js') }}"></script>

<script>
    var baseUrl = "{{ url('/') }}";
</script>
<script src="{{ asset('/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('/lib/popper.min.js') }}"></script>
<script src="{{ asset('/js/admin/easion.js') }}"></script>
<script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
@if (isset($js_files))
    @foreach ($js_files as $js)
        <script src="{{ asset("$js") }}"></script>
    @endforeach
@endif
