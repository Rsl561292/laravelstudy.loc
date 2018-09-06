@extends('.modules.profile.layouts.main')

@php
    $listButton = [
        [
            'btnType' => 'create',
            'classBtnType' => 'btn-primary',
            'nameRoute' => 'articles.create',
            'btnTitle' => 'Add New Article'
        ]
    ];
@endphp

@section('titlePage', 'Your articles')

@section('content')
    {{$dataTable->table(['id' => 'articles'])}}
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush

