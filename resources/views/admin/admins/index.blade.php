

@extends('admin.dashboard')
@include('admin.partial.flash')

@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> Admin Pannel </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main</a>
                            </li>
                            <li class="breadcrumb-item active"> Admin
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body ">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <h4 class="card-title">Admin Pannel <small style="color: blue;font-weight:bold; font-size:25px">{{$admins->total()}}</small> </h4>


                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>





                                        <div class="btn-group d-flex flex-column" role="group"
                                        aria-label="Basic example">





                                            <form action="{{route('admin.index')}}" method="get">


                                             <div class="row">

                                                 <div class="col-md-8">
                                                     <input type="text" name="search" class="form-control" placeholder="Search" value="{{request()->search}}" style="color:red; background-color:bisque;
                                                     font-size:15px">

                                                 </div>

                                                 <div class="col-md-2">

                                                     <button type="submit" class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1 " style="font-size: 15px;"><i class="fa fa-search"></i> search</button>

                                                 </div>
                                             </div>
                                            </form>



<div>
    @if(auth()->user()->hasPermission('admins-delete'))
    <a href="{{ route('admin.trash') }}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 " style="font-size: 15px;">trashed</a>

    @else

    <button class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 disapled" style="font-size: 15px;">Disabled</button>


    @endif






    @if(auth()->user()->hasPermission('admins-create'))
    <a href="{{ route('admin.create') }}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1 " style="font-size: 15px;">Create User</a>

    @else

    <button class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1 disapled" style="font-size: 15px;">Disabled</button>


    @endif

</div>














</div>











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

                                    @if($admins->count() > 0)
                                    <table
                                        class="table display nowrap table-striped table-bordered ">
                                        <thead>
                                        <tr>
                                            <th >#</th>
                                            <th> Name</th>
                                            <th >Email</th>
                                            <th >Photo</th>
                                            <th >Updated_At</th>
                                            <th class="col-sm-0">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($admins as $index=>$admin)
                                                <tr>
                                                    <td >{{ $index +1 }} </td>
                                                    <td >{{ $admin->name}}</td>
                                                    <td > {{ $admin->email}}</td>
                                                    <td ><img src="{{ $admin->image_path}}" style="width:100px; " class="img-thumbnail"alt="" ></td>
                                                    <td>{{ $admin->updated_at->diffForhumans() }}</td>
                                                    <td class="col-sm-0">


                                                        <div class="btn-group" role="group"
                                                        aria-label="Basic example">

                                                        @if(auth()->user()->hasPermission('admins-update'))

                                                        <a href="{{ route('admin.edit' ,$admin->id)}}" class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1" style="font-size: 15px; min-width: 0.5rem;">Edit</a>

                                                        @else

                                                        <button class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1 disapled" style="font-size: 15px;">Disabled</button>


                                                        @endif


                                                        @if(auth()->user()->hasPermission('admins-delete'))
                                                        <a href="javascript:void(0)" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 " style="font-size: 15px;min-width: 0.5rem;" onclick="if(confirm('Are you sure?')){ document.getElementById('delete-{{$admin->id}}').submit();}else{ return false;} ">Del</a>
                                                        <form action="{{ route('admin.destroy',$admin->id)}}" method="POST" id="delete-{{$admin->id}}" style="display: none;">
                                                          @csrf
                                                          @method('DELETE')

                                                        </form>
                                                        @else

                                                        <button class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1 disapled" style="font-size: 15px;">Disabled</button>
                                                        @endif

                                                    </div>

                                                        {{-- <div class="btn-group" role="group"
                                                             aria-label="Basic example">
                                                            <a href=""
                                                               class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                            <button type="button"
                                                                    value=""
                                                                    onclick=""
                                                                    class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1"
                                                                    data-toggle="modal"
                                                                    data-target="#rotateInUpRight">
                                                                حذف
                                                            </button>

                                                        </div> --}}
                                                    </td>
                                                </tr>

                                                @endforeach

                                        </tbody>
                                    </table>

                                    @else
                                <h2>sorry , there is no data</h2>

                                @endif
                                    <div class="justify-content-center d-flex">

                                        <div class="float-end">

                                            {!! $admins->appends(request()->query())->links('pagination::bootstrap-4') !!}
                                        </div>

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
