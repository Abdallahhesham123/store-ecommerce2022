@extends('admin.dashboard')
@include('admin.partial.flash')
@section('abdallah')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 style="color:red;" class="text-center">Edit Admin {{ $admin->name}}</h1>
            <form action="{{route('admin.update',$admin->id)}}" method="POST" enctype="multipart/form-data">

                @csrf
                @Method('PUT')


                    <div class="form-group">


                      <label for="exampleFormControlInput1">Name</label>
                      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="enter your name" name="name" value="{{ $admin->name}}">
                      @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="form-group">


                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="enter your email"  name="email" value="{{ $admin->email}}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                      </div>


                      <div class="form-group">


                        <label for="exampleFormControlInput1">Image</label>
                        <input type="file" class="form-control image" id="exampleFormControlInput1" placeholder="enter your email" name="image" >
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                      </div>


                      <div class="form-group">
                        <img src="{{$admin->image_path}}"  style="width:100px" class="img-thumbnail image-preview"alt="">
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
                              <div class="tab-content">

                                  @foreach ($models as $index=>$model)
                                           <div class="tab-pane {{ $index == 0 ? 'active' :''}}" id="{{$model}}">


                                  @foreach ($maps as $map)

                                         <label for=""><input type="checkbox" name="permissions[]" {{ $admin->hasPermission($model .'-' . $map) ? 'checked' : '' }} value="{{ $model .'-' . $map}}"> {{ $map }}</label>
                                  @endforeach

                                        </div>

                                  @endforeach
                              </div>








                      <div class="text-center mt-5">
                      <button type="submit" class="btn btn-primary" style="font-size: 23px;">Update</button>
                  </div>



                  </form>
              </form>

        </div>
    </div>
</div>
@endsection
