@if($errors->any())

<div class="alert alert-danger " role="alert" id="alert-session">
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>

    @endforeach

   </div>
 @endif
