
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


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
        <form id="addForm">

            <div class="modal-body">
                {{--start the form of the modal --}}
                <ul id="saveform_errList"></ul>
                <div class="form-group form-group-sm mb-3">
                    <label for="formGroupExampleInput" class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Example 'cucumber'">
                  </div>
                  <label for="formGroupExampleInput2" class="form-label">Product Price</label>
                  <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">dkk</span>
                    <input type="decimal" class="form-control" name="price" id="price" placeholder="Example '6.95'">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary add-product" id="btn-save">Create</button>
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
    <form id="editForm" >
        <div class="modal-body">
            {{--start the form of the modal --}}
            <ul id="updateform_errList"></ul>
            <input type="hidden" id="edit_prod_id">
            <div class="form-group form-group-sm mb-3">
                <label for="formGroupExampleEInput" class="form-label">Product Name</label>
                <input type="text" class="form-control" name="name" id="edit_name" placeholder="Enter new name" required>
              </div>
              <label for="formGroupExampleInput2" class="form-label">Product Price</label>
              <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">dkk</span>
                <input type="decimal" class="form-control" name="price" id="edit_price" placeholder="Enter new price'" required>
              </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary update_prod">Update</button>
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
    <form id="deleteForm" >
        <div class="modal-body">
            <input type="hidden" id="delete_prod_id">
            <h4>Confirm to delete product</h4>
            <input type="hidden" name="_method" value="DELETE">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary delete_prod">Delete</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  <!-- end of modal delete product -->

<div class="container py-y">
    <div class="card">
        <div class="card-header">
    <h1>Products
        <button type="button" class="btn btn-primary float-end create-new-product" id="create-new-product" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color:green">
        Create New Product
      </button></h1>
   <div id="success-message"></div>

        </div>
    </div>
      <style type="text/css">
        .currency:after{content:' dkk';}

      </style>
      <table id="datatable" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th scope="col" data-visible="false" style="display:none;">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Actons</th>
          </tr>
        </thead>
        <tbody id="products-crud">

        </tbody>
      </table>

</div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script>

$(document).ready(function(){
//fetching data in table
    fetchProducts();
    function fetchProducts(){
        $.ajax({
            type:"GET",
            url:"/fetch-products",
            dataType:"json",
            success: function(response){
                $('tbody').html("");
                $.each(response.products,function(key,item){
                    $('tbody').append('<tr>\
                            <td style="display:none;">'+item.id+'</td>\
                            <td>'+item.name+'</td>\
                            <td class="currency">'+item.price+'</td>\
                            <td>\
                                <button type="button" value="'+item.id+'" class="edit btn btn-light " style="color:blue">Edit </button>\
                                    |\
                                <button type="button" value="'+item.id+'" class="delete btn btn-light " style="color:blue">Delete </button>\
                            </td>\
                        </tr>');
                });
            }

        });

    }
    //deleting data
    $(document).on('click','.delete', function (e) {
        e.preventDefault();
        var prod_id= $(this).val();
        //alert(prod_id);
        $('#delete_prod_id').val(prod_id);
        $('#deleteModal').modal('show')

    });
    $(document).on('click','.delete_prod', function (e) {
        e.preventDefault();
        var prod_id=$('#delete_prod_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/delete-products/"+prod_id,
            //data: "data",
            //dataType: "dataType",
            success: function (response) {
                console.log(response);
                $('#success-message').addClass('alert alert-success');
                $('#success-message').text(response.message);
                $('#deleteModal').modal('hide')
                fetchProducts();
            }
        });

    });


//editing data
    $(document).on('click' ,'.edit',function(e){
        e.preventDefault();
        var prod_id = $(this).val();
        console.log(prod_id);
        $('#editModal').modal('show');
        $.ajax({
            type:"GET",
            url:"/edit-products/"+prod_id,
            dataType:"json",
            success:function(response){
                console.log(response);
                if(response.status==404){
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-danger');
                    $('#success_message').text(response.message);

                }
                else{
                    $('#edit_name').val(response.product.name);
                    $('#edit_price').val(response.product.price);
                    $('#edit_prod_id').val(prod_id);

                }
            }
        });

    });
    $(document).on('click','.update_prod', function (e) {
        e.preventDefault();
        var prod_id=$('#edit_prod_id').val();
        var data={
            'name':$('#edit_name').val(),
            'price':$('#edit_price').val(),
        }
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: "PUT",
            url: "/update-products/"+prod_id,
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response.status==400){
                    $('#updateform_errList').html("");
                    $('#updateform_errList').addClass('alert alert-danger');
                    $.each(response.errors,function(key,err_values){
                        $('#updateform_errList').append('<li>'+err_values+'</li>');

                    });
                }
                else if(response.status==404){
                    $('#updateform_errList').html("");
                    $('#success-message').addClass('alert alert-success');
                    $('#success-message').text(response.message);
                }
                else{
                    $('#updateform_errList').html("");
                    $('#success-message').html("");
                    $('#success-message').addClass('alert alert-success');
                    $('#success-message').text(response.message);

                    $('#editModal').modal('hide');
                    fetchProducts();
                }
            }
        });
    });
//inserting data
    $(document).on('click' ,'.add-product',function(e){
        e.preventDefault();

        var data={
            'name':$("#name").val(),
            'price':$("#price").val(),

        }
        console.log(data);

        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
        $.ajax({
            type:"POST",
            url:"/products",
            data:data,
            dataType:"json",
            success:function(response){
                console.log(response);
                if(response.status==400){
                    $('#saveform_errList').html("");
                    $('#saveform_errList').addClass('alert alert-danger');
                    $.each(response.errors,function(key,err_values){
                        $('#saveform_errList').append('<li>'+err_values+'</li>');

                    });
                }
                else{
                    $('#saveform_errList').html("");
                    $('#success-message').addClass('alert alert-success');
                    $('#success-message').text(response.message);
                    $('#exampleModal').modal('hide');
                    $('#exampleModal').find('input').val("");
                    $('#datatable').DataTable().ajax.reaload();
                    fetchProducts();
                }
            }


        });
    });


});

</script>
</body>
</html>
