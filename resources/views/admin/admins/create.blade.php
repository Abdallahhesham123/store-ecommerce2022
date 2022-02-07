

@extends('admin.dashboard')

@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main Dashboard </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}"> Admin Pannel </a>
                            </li>
                            <li class="breadcrumb-item active">Add Admin
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> إضافة لغة </h4>
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
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.store')}}" method="POST"
                                          enctype="multipart/form-data">
                                          @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> Admin Data </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">Name </label>
                                                        <input type="text"  id="name"
                                                               class="form-control"
                                                               placeholder="اPlease enter your name"
                                                               name="name" value="{{old('name')}}">
                                                        {{-- <span class="text-danger"> </span> --}}

                                                        @error('name')
                                                        <div class="alert alert-danger text-center">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Email</label>
                                                        <input type="email"  id="name"
                                                               class="form-control"
                                                               placeholder="PLease enter your email "
                                                               name="email" value="{{old('email')}}">
                                                               @error('email')
                                                               <div class="alert alert-danger text-center">{{ $message }}</div>
                                                           @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Image </label>
                                                        <input type="file" id="name"
                                                               class="form-control image"
                                                               placeholder="enter your image"
                                                               name="image">
                                                               @error('image')
                                                               <div class="alert alert-danger text-center">{{ $message }}</div>
                                                           @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <img src="{{asset('uploads/user_images/default.png')}}"  style="width:100px" class="img-thumbnail image-preview"alt="">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        {{-- <label for="projectinput1"> Password </label> --}}
                                                        <label for="inputPassword4">Password</label>
                                                        <input type="Password" class="form-control password" id="inputPassword4" placeholder="Your password" name="password" >
                                                        <div class="form-control-position" style="color:blueviolet">
                                                            <i class="la la-unlock-alt show-pass"></i>
                                                        </div>

                                                        @error('password')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="inputPassword4">Confirmation Password</label>
                                                        <input type="Password" class="form-control password" id="inputPassword4" placeholder="Your password" name="cpassword" >
                                                        <div class="form-control-position" style="color:blueviolet">
                                                            <i class="la la-unlock-alt show-pass"></i>
                                                        </div>
                                                        @error('cpassword')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            @php


                                            $models=['admins','categorries','products'];
                                            $maps=['create','read','update','delete'];

                                            @endphp

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                                    @foreach ($models as $index=>$model)

                                                        <li class="nav-item">
                                                        <a class="nav-link {{ $index == 0 ? 'active' :''}}" id="pills-home-tab" data-toggle="pill" href="#{{$model}}" role="tab" aria-controls="pills-home" aria-selected="true">{{ $model }} </a>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="tab-content d-flex justify-content-around">

                                                    @foreach ($models as $index=>$model)
                                                             <div class="tab-pane {{ $index == 0 ? 'active' :''}} " id="{{$model}}" style="">


                                                    @foreach ($maps as $map)

                                                           <label for=""><input type="checkbox" name="permissions[]" value="{{ $model .'-' . $map}}"> {{ $map }}</label>
                                                    @endforeach

                                                          </div>

                                                    @endforeach
                                                </div>




{{--
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox" name="status"
                                                               id="switcheryColor4"
                                                               class="switchery" data-color="success"
                                                               checked/>
                                                        <label for="switcheryColor4"
                                                               class="card-title ml-1">الحالة </label>
                                                    </div>
                                                </div>
                                            </div> --}}



                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> Back
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> Save
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
@endsection
