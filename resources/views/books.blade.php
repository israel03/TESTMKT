@extends('layouts.menu')

@section('title', 'Books')

@section('content')

<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">
  + Add book
</button>

<button type="button" class="btn btn-primary mb-4 float-right" data-toggle="modal" data-target="#modalTwo">
  x Reserve book
</button>

<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($book as $boo)
            <tr>
                <td>{{$boo->name}}</td>
                <td>{{$boo->author}}</td>
                <td>{{$boo->category}}</td>
                <td>
                    @if($boo->user_id != NULL)
                    <span class="badge badge-danger">Reserved</span>
                    @else
                    <span class="badge badge-success">Available</span>
                    @endif
                </td>
                <td>
                @if($boo->user_id != NULL)
                <button class="btn btn-info" onclick="deleteStatus({{$boo->id}});">Change Status</button>
                @endif
                    <button class="btn btn-danger" onclick="deleteRecord({{$boo->id}});">Delete</button>
                </td>

                
            </tr>

            @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </tfoot>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
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
                    <input type="text" class="form-control" onkeypress="return validateLetters(event)" maxlength="240" minlength="2" id="name" name="name" placeholder="Name" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="author" class="col-sm-2 col-form-label">Author</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" onkeypress="return validateLetters(event)" maxlength="240" minlength="2" id="author" name="author" placeholder="Author" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                    <select class="custom-select" id="category" name="category" required>
                        <option value="">Choose an option...</option>
                        @foreach($category as $cat)
                            <option value="{{$cat->name}}">{{$cat->name}}</option>

                        @endforeach
                    </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="published" class="col-sm-2 col-form-label">Published Date</label>
                    <div class="col-sm-10">
                        <input type="date" min="1600-01-01" class="form-control" id="published" name="published" required>
                    
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <div class="col">
                    <button type="submit" class="btn btn-primary float-right">Save Book</button>
                    </div>
                </div>
            </form>

        
        
      </div>
    </div>
  </div>
</div>




<!-- Modal TWo-->
<div class="modal fade" id="modalTwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reserve Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


            <form id="form2">
                @csrf

                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Select User</label>
                    <div class="col-sm-10">
                    <select class="custom-select" id="user" name="user" required>
                        <option value="">Choose an option...</option>
                        @foreach($user as $use)
                            <option value="{{$use->id}}">{{$use->name}}</option>

                        @endforeach
                    </select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="category" class="col-sm-2 col-form-label">Select a book</label>
                    <div class="col-sm-10">
                    <select class="custom-select" id="book" name="book" required>
                        <option value="">Choose an option...</option>
                        @foreach($book as $boo)

                       
                            <option value="{{$boo->id}}">{{$boo->name}}</option>
                    

                        @endforeach
                    </select>
                    </div>
                </div>
                
                
                <div class="form-group row">
                    <div class="col">
                    <button type="submit" class="btn btn-primary float-right">Reserve Book</button>
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
              url: 'saveBook',
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


      $('#form2').submit(function (event){

            event.preventDefault();

            var fdata =  $('#form2').serialize();

            $.ajax({
                url: 'reserveBook',
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
                url: 'deleteBook',
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

  function deleteStatus(id){

    $.ajax({
            url: 'deleteStatus',
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


