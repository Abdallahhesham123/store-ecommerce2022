
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
                            <li class="breadcrumb-item"><a href="">الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href=""> الاقسام الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active">Update == {{$maincat->name}}
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
                                <h4 class="card-title" id="basic-layout-form">Update main cat </h4>
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
                                    <form class="form" action="{{route('admin.maincat.update',$maincat->id)}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        {{-- id in validation  = name of form

                      this field to validation only if we want to not make validation in image  for example


                                            --}}
                                        <input type="hidden" name="id" value="{{$maincat->id}}">
                                        <div class="form-group">
                                            <label> Image of Category </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="image"  class="form-control image">
                                                <span class="file-custom "></span>
                                            </label>
                                            @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="text-center">
                                                <img src="{{$maincat->image}}"  style="width:100px" class="img-thumbnail image-preview"alt=" no image">

                                            </div>
                                        </div>

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> Data  </h4>


                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="projectinput1"> Name of{{__('messages.'.$maincat ->name)}}  </label>
                                                                <input type="text" value="{{$maincat -> name}}" id="name"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       name="category[0][name]">
                                                                @error("category.0.name")
                                                                <span class="text-danger">this field required </span>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6 mt-2">
                                                            <div class="form-group mt-1">
                                                                <input type="checkbox" value="1"
                                                                       name="category[0][active]"
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                      @if($maincat->active == 1  )  checked @endif/>
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">Status  {{__('messages.'.$maincat ->trans_lang)}} </label>

                                                                @error("category.0.active")
                                                                <span class="text-danger">{{ $message }} </span>
                                                                @enderror
                                                            </div>
                                                        </div>



                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6 hidden">
                                                            <div class="form-group">
                                                                <label for="projectinput1">  {{__('messages.'.$maincat ->trans_lang)}} </label>
                                                                <input type="text" id="abbr"
                                                                       class="form-control"
                                                                       placeholder="  "
                                                                       value="{{$maincat ->trans_lang}}"
                                                                       name="category[0][abbr]">

                                                                @error("category.0.abbr")
                                                                <span class="text-danger">this field required</span>
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
                                                <i class="la la-check-square-o"></i>Update
                                            </button>
                                        </div>
                                    </form>
                                    <ul class="nav nav-tabs nav-justified">

                                        @isset($maincat->category)
                                        @foreach($maincat->category as $index => $translation)
                                        <li class="nav-item">
                                            <a class="nav-link active" id="activeLable1-tab1" data-toggle="tab" href="#activeLable1{{$index}}"
                                            aria-controls="activeLable1" aria-expanded="true">
                                              <span class="badge badge-pill badge-glow badge-default badge-success">{{$index +1}}</span><b style="font-size: 30px; margin-left:50px">{{ $translation->trans_lang }}</b></a>
                                          </li>


                                          @endforeach
                                          @endisset
                                      </ul>
                                      <div class="tab-content px-1 pt-1">

                                        @isset($maincat->category)
                                        @foreach($maincat->category as $index => $translation)
                                        <div role="tabpanel" class="tab-pane active" id="activeLable1{{$index}}" aria-labelledby="activeLable1-tab1"
                                        aria-expanded="true">
                                        <form class="form" action="{{route('admin.maincat.update',$translation->id)}}"
                                            method="POST"
                                            enctype="multipart/form-data">
                                          @csrf
                                          @method('put')

                                          {{-- id in validation  = name of form

                        this field to validation only if we want to not make validation in image  for example


                                              --}}
                                          <input type="hidden" name="id" value="{{$translation->id}}">


                                          <div class="form-body">

                                              <h4 class="form-section"><i class="ft-home"></i> Data  </h4>


                                                      <div class="row">
                                                          <div class="col-md-6">
                                                              <div class="form-group">
                                                                  <label for="projectinput1"> Name of{{__('messages.'.$translation ->name)}}  </label>
                                                                  <input type="text" value="{{$translation-> name}}" id="name"
                                                                         class="form-control"
                                                                         placeholder="  "
                                                                         name="category[0][name]">
                                                                  @error("category.0.name")
                                                                  <span class="text-danger">this field required </span>
                                                                  @enderror
                                                              </div>
                                                          </div>


                                                          <div class="col-md-6 mt-2">
                                                              <div class="form-group mt-1">
                                                                  <input type="checkbox" value="1"
                                                                         name="category[0][active]"
                                                                         id="switcheryColor4"
                                                                         class="switchery" data-color="success"
                                                                        @if($translation->active == 1  )  checked @endif/>
                                                                  <label for="switcheryColor4"
                                                                         class="card-title ml-1">Status  {{__('messages.'.$translation ->trans_lang)}} </label>

                                                                  @error("category.0.active")
                                                                  <span class="text-danger">{{ $message }} </span>
                                                                  @enderror
                                                              </div>
                                                          </div>



                                                      </div>
                                                      <div class="row">

                                                          <div class="col-md-6 hidden">
                                                              <div class="form-group">
                                                                  <label for="projectinput1">  {{__('messages.'.$translation ->trans_lang)}} </label>
                                                                  <input type="text" id="abbr"
                                                                         class="form-control"
                                                                         placeholder="  "
                                                                         value="{{$translation->trans_lang}}"
                                                                         name="category[0][abbr]">

                                                                  @error("category.0.abbr")
                                                                  <span class="text-danger">this field required</span>
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
                                                  <i class="la la-check-square-o"></i>Update
                                              </button>
                                          </div>
                                      </form>
                                        </div>
                                        @endforeach
                                        @endisset
                                      </div>

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
