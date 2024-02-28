<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <!-- DataTables CSS -->
     <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>@yield('title')</title>
  </head>
  <body>
    <div class="container-fluid">
      <ul class="nav justify-content-center mb-3">
          <li class="nav-item">
              <a class="nav-link" href="/">Books</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/category">Category</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/users">Users</a>
          </li>
      </ul>

      @yield('content')
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
      $(document).ready(function() {
                  $('#example').DataTable({
                      "language": {
                          "lengthMenu": "Mostrar _MENU_ registros por página",
                          "zeroRecords": "No se encontraron resultados",
                          "info": "Mostrando página _PAGE_ de _PAGES_",
                          "infoEmpty": "No hay registros disponibles",
                          "infoFiltered": "(filtrado de _MAX_ registros totales)",
                          "search": "Buscar:",
                          "paginate": {
                              "first": "Primero",
                              "last": "Último",
                              "next": "Siguiente",
                              "previous": "Anterior"
                          }
                      },
                      "lengthMenu": [5, 10, 25, 50]
                  });
              });
    </script>

    @yield('scripts')
  
  
  </body>
</html>