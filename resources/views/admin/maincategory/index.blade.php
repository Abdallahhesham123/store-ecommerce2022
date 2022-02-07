
@extends('admin.dashboard')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> MainCategories </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Main</a>
                            </li>
                            <li class="breadcrumb-item active"> MainCategories
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All MainCategories</h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table
                                        class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead>
                                        <tr>
                                            <th> Name of Main CATEGORY</th>
                                            <th>languges</th>
                                            <th>image</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                       @isset($cats)
                                       @foreach($cats as $cat)
                                                <tr>
                                                    <td> {{$cat->name}}</td>
                                                    <td> {{get_default_lang()}}</td>
                                                    <td> <img src="{{ $cat->image }}" style="width:100px;height:100px;"> </td>
                                                    <td> {{$cat->getactive()}} </td>
                                                    <td>
                                                        <div class="btn-group" role="group"
                                                             aria-label="Basic example">
                                                            <a href="{{route('admin.maincat.edit',$cat->id)}}"
                                                               class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>

                                                                <a href=""
                                                                class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">Active</a>



                                                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1" style="font-size: 15px;" onclick="if(confirm('Are you sure?')){ document.getElementById('delete-{{$cat->id}}').submit();}else{ return false;} ">Delete</a>
                                                                <form action="" method="POST" id="delete-{{$cat->id}}" style="display: none;">
                                                                  @csrf
                                                                  @method('DELETE')

                                                                </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endisset

                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
