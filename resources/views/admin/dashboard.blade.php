@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                @include('admin.includes.alerts.success')
            </div>
            <div class="content-body">
               @yield('abdallah')
            </div>
        </div>
    </div>
@endsection
