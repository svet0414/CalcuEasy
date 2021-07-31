<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>CalcuEasy</title>
</head>
<body>
     <!-- Modal add product -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create New Product</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <form method="POST" action="{{ route('products.store') }}" >
            {{csrf_field()}}
            <div class="modal-body">
                {{--start the form of the modal --}}

                <div class="form-group form-group-sm mb-3">
                    <label for="formGroupExampleInput" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Example 'cucumber'">
                  </div>
                  <label for="formGroupExampleInput2" class="form-label">Product Price</label>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">dkk</span>
                    <input type="decimal" class="form-control" name="price" placeholder="Example '6.95'">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
          </div>
        </div>
      </div>
  <!-- end of modal add product -->


 <!-- Modal edit product -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    <form action="products.update" method="POST" id="editForm" >
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="modal-body">
            {{--start the form of the modal --}}

            <div class="form-group form-group-sm mb-3">
                <label for="formGroupExampleEInput" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter new name" required>
              </div>
              <label for="formGroupExampleInput2" class="form-label">Product Price</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">dkk</span>
                <input type="decimal" class="form-control" name="price" id="price" placeholder="Enter new price'" required>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- end of modal edit product -->


<!-- Modal delete product -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    <form action="products.update" method="POST" id="deleteForm" >
        {{csrf_field()}}
        {{method_field('DELETE')}}
        <div class="modal-body">
            <input type="hidden" name="_method" value="DELETE">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- end of modal delete product -->

<div class="container">
    <h1>Products</h1>
    @if(count($errors)>0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
    @endif

    @if(\Session::has('success'))
        <div class='alert alert-success'>
            <p> {{\Session::get('success')}}</p>
        </div>
    @endif
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create New Product
      </button>
      <style type="text/css">
        .currency:after{content:' dkk';}

      </style>
      <table id="datatable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col" data-visible="false">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Actons</th>
          </tr>
        </thead>
        <tbody>
           @foreach ($products as $prodData )
          <tr>
            <td>{{$prodData->id}}</td>
            <td>{{$prodData->name}}</td>
            <td class="currency">{{$prodData->price}}</td>
            <td>
              <a href="#" class="btn btn-light edit" style="color:blue">Edit </a>
                |
              <a href="#" class="btn btn-light delete" style="color:blue">Delete </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>


<script type="text/javascript">

    $(document).ready(function(){
        var table=$('#datatable').DataTable();
        //edit
        table.on('click','.edit', function(){
            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);
            $('#name').val(data[1]);
            $('#price').val(data[2]);

            $('#editForm').attr('action','products/'+data[0]);
            $('#editModal').modal('show');
        });
        //edit end

        //delete
        table.on('click','.delete', function(){
            $tr=$(this).closest('tr');
            if($($tr).hasClass('child')){
                $tr=$tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);
            $('#id').val(data[0])

            $('#deleteForm').attr('action','products/'+data[0]);
            $('#deleteModal').modal('show');
        });
        //delete end
    });

</script>

<!--<script>
$(document).ready(function(){
  $('.editBTN').on('click', function(){
      $('#editModal').modal('show')



  })

});

</script>-->>


</body>
</html>
