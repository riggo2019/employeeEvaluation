<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@if (isset($js_files))
    @foreach ($js_files as $js)
        <script src="{{ asset("$js") }}"></script>
    @endforeach
@endif