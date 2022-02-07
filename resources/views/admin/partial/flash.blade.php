
@if(session('message'))

<div class="alert alert-{{ session('alert-type')}} alert-dismissible fade show text-center" role="alert" id="alert-session">
   {{ session('message')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Close</button>
  </div>


  @endif
