@extends('admin.layouts.master')
@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" />
    <section class="section">
        <div class="section-header">
            <h1>Delivery Area</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Delivery Area</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.delivery-area.create') }}" class="btn btn-primary">
                        Create New
                    </a>
                </div>
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