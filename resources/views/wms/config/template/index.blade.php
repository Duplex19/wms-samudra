@extends('layouts.app')
@section('content')
<h4 class="text-header">Template WhatsApp</h4>
<div class="row" id="dataTemplate">
        <x-skeleton />
</div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            getData();
        });

        async function getData() {
            let param = {
                'url': '{{ url()->current() }}',
                'method': 'GET',
            }

            await transAjax(param).then((result) => {
                $("#dataTemplate").html(result);
            }).catch((err) => {
                console.log(err);
            });
        }
    </script>
@endpush