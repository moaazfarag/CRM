<div class="no-print">
@if(Session::has('success'))
    <script type='text/javascript'>
        $(document).ready( function() {
            Materialize.toast('{{ Session::get('success')}}', 5000)
        });
    </script>
@elseif(Session::has('error'))
    <script type='text/javascript'>
        $(document).ready( function() {
            Materialize.toast('{{ Session::get('error') }}', 5000)
        });
    </script>
@endif
</div>