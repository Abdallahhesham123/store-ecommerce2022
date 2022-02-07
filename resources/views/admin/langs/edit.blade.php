
﻿ 
@extends('admin.dashboard')

@section('content')




<div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Main DashBoard </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.lang')}}"> Languages </a>
                                </li>
                                <li class="breadcrumb-item active">update Languages
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
                                    {{-- <div class="card-header justify-content-between" style="font-size:60px;">



                                        <h1>All_Trashed</h1>
                     
                     
                                         <a href="{{ route('admin.index')}}" class="btn btn-success btn-sm" style="font-size: 15px;">Admin Home</a>
                                     </div> --}}
                                    <h4 class="card-title" id="basic-layout-form"> Add Languages </h4>
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
                                        <form class="form" action="{{route('admin.lang.update',$lang->id)}}" method="POST"   enctype="multipart/form-data">

                                            @csrf
                                            @method('Put')
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>Languages data </h4>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Name </label>
                                                            <input type="text"  id="name"
                                                                   class="form-control"
                                                                   placeholder="Please enter your name  "
                                                                   name="name"
                                                                   value="{{$lang->name}}">

                                                                   @error('name')
                                                                   <div class="alert alert-danger text-center"> {{ $message }}</div>

                                                                 
                                                               @enderror
                                                         
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Abbr </label>
                                                            <input type="text" value="{{$lang->abbr}}" id="name"
                                                                   class="form-control"
                                                                   placeholder="please enter abbr of lang"
                                                                   name="abbr">
                                                                   
                                                                   @error('abbr')
                                                                   <div class="alert alert-danger text-center"> {{ $message }}</div>

                                                                 
                                                               @enderror
                                                            
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاختصار </label>
                                                            <input type="text" value="" id="name"
                                                                   class="form-control"
                                                                   placeholder="ادخل اختصار اللغة     "
                                                                   name="name">
                                                            <span class="text-danger"> </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاختصار </label>
                                                            <input type="text" value="" id="name"
                                                                   class="form-control"
                                                                   placeholder="ادخل اختصار اللغة     "
                                                                   name="name">
                                                            <span class="text-danger"> </span>
                                                        </div>
                                                    </div>

                                                </div> --}}


                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Direction </label>
                                                            <select name="direction" class="select2 form-control">
                                                                <optgroup label="PLease enter your direction ">
                                                                    <option value="rtl" {{$lang->direction =='rtl' ? 'selected' : ''}}>RTL</option>
                                                                    <option value="ltr" {{$lang->direction =='ltr' ? 'selected' : ''}}>LTR</option>
                                                                </optgroup>
                                                            </select>
                                                            @error('direction')
                                                            <div class="alert alert-danger text-center"> {{ $message }}</div>

                                                          
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1" name="active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                 {{  $lang->active == 1 ? 'checked' :'' }} />
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">Status </label>

                                                                   @error('active')
                                                                   <div class="alert alert-danger text-center"> {{ $message }}</div>
       
                                                                 
                                                               @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> Back
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Update
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