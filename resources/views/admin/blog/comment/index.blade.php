@extends('admin.layouts.master')
@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" />
    <section class="section">
        <div class="section-header">
            <h1>Blog Comment</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Blog Comment</h4>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
