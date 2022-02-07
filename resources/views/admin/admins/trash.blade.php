@extends('admin.dashboard')
@include('admin.partial.flash')
@section('abdallah')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header justify-content-between" style="font-size:60px;">



                   <h1>All_Trashed</h1>


                    <a href="{{ route('admin.index')}}" class="btn btn-success btn-sm" style="font-size: 15px;">Admin Home</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">






                      @if($admins->count() > 0)

                        <table class="table table-bordered table-hover scroll-horizontal">

                            <thead>
                                <tr  class=" text-center" style="background-color:blue; color:#fff; border: 3px solid #222;" >
                                    <th>Index</th>

                                    <th> Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Post_Created_At</th>
                                    <th>Post_Updated_At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($admins as $admin)
                                <tr class=" text-center">
                                    <td>{{ $admin->id}}</td>
                                    <td>{{ $admin->name}}</td>

                                    <td>{{ $admin->email}}</td>
                                    <td><img src="{{ $admin->image_path}}" style="width:100px; " class="img-thumbnail"alt="" ></td>

                                    <td>{{ $admin->created_at->diffForhumans() }}</td>
                                    <td>{{ $admin->updated_at->diffForhumans() }}</td>
                                    <td class=" justify-content-center" style="display:flex; gap:5px;">

                                        <a href="{{ route('admin.restore' ,$admin->id)}}" class="btn btn-success btn-sm" style="font-size: 15px;">Restore</a>
                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure?')){ document.getElementById('delete-{{$admin->id}}').submit();}else{ return false;} " style="font-size: 15px;">Delete</a>
                                        <form action="{{ route('admin.hdelete',$admin->id)}}" method="POST" id="delete-{{$admin->id}}" style="display: none;">
                                          @csrf
                                          @method('DELETE')

                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                           </table>
                    </div>
                            <div class="float-end">

                                {!! $admins->links('pagination::bootstrap-4') !!}
                            </div>
                </div>

                @else
                <h2>sorry , there is your trash bin</h2>

                @endif
            </div>
        </div>
    </div>




@endsection
