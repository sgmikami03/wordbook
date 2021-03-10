@if($errors->any())

  <div class="card-text alert alert-danger text-left">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>

@endif