@extends('layouts.menu')

@section('title', 'Users')

@section('content')

<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
  + Add user
</button>

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
          @foreach($user as $us)
            <tr>
                <td>{{$us->name}}</td>
                <td>{{$us->email}}</td>
                <td><button class="btn btn-danger float-right" onclick="deleteRecord({{$us->id}});">Delete</button></td>
            </tr>

            @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </tfoot>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


            <form id="form1">
              @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" onkeypress="return validateLetters(event)" class="form-control" maxlength="240" minlength="2" id="name" name="name" placeholder="Name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="author" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" maxlength="240" minlength="2" id="email" name="email" placeholder="Author" required>
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="col">
                    <button type="submit" class="btn btn-primary float-right">Save user</button>
                    </div>
                </div>
            </form>

        
        
      </div>
    </div>
  </div>
</div>
@endsection


@section('scripts')

<script>
  $(document).ready(function(){

      $('#form1').submit(function (event){

          event.preventDefault();

          var fdata =  $('#form1').serialize();

          $.ajax({
              url: 'saveUser',
              type: 'post',
              data: fdata,
              success: function(response) {
                  if(response.status == 200){
                  alert(response.message);
                  location.reload();

                  

                  }else if(response.status == 400){
                  alert(response.message);
                  }
              },
              error: function(error) {
                  
                  console.log(error);
              }
          });

         

          

      });

  });
</script>

<script>
  
  function deleteRecord(id){

      $.ajax({
                url: 'deleteUser',
                type: 'get',
                data: {'id':id},
                success: function(response) {
                    if(response.status == 200){
                      alert(response.message);
                      location.reload();

                    }else if(response.status == 400){
                      alert(response.message);
                    }
                },
                error: function(error) {
                    
                    console.log(error);
                }
            });

  }

  function validateLetters(event){

    const charCode = (event.which) ? event.which : event.keyCode;
    const char = String.fromCharCode(charCode);
    const letrasConAcentos = /[A-Za-záéíóúÁÉÍÓÚ ]/;

    return letrasConAcentos.test(char);
  }

</script>

@endsection


