@extends('admin.layouts.master')
@section('content')
<meta name="csrf_token" content="{{ csrf_token() }}" />
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>User</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
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
