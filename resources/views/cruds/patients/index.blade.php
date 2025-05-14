@extends(
    auth()->guard('admin')->check()
        ? 'users.admin.layouts.master'
        : 'users.doctor.layouts.master'
)

@extends('cruds.layouts.index')

@section('title')
    {{ __('users.patients') }}
@endsection

@section('card-handle')
    @if (auth()->guard('admin')->check())
        <a href="{{ route('patients.create') }}" class="btn btn-primary">{{ __('handle.create') }}</a>
    @endif
@endsection

@section('card-body')
    @include('cruds.patients.partials.index-table')
@endsection
