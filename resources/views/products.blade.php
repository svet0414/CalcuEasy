
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <h1>Products</h1>
   <div id="success-message"></div>
    <button type="button" class="btn btn-primary create-new-product" id="create-new-product" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create New Product
      </button>
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
           @foreach ($products as $prodData )

          @endforeach
        </tbody>
      </table>

</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>

    // $(document).ready(function(){
    //     var table=$('#datatable').DataTable();
    //     //edit
    //     table.on('click','.edit', function(){
    //         $tr=$(this).closest('tr');
    //         if($($tr).hasClass('child')){
    //             $tr=$tr.prev('.parent');
    //         }

    //         var data = table.row($tr).data();
    //         console.log(data);
    //         $('#name').val(data[1]);
    //         $('#price').val(data[2]);

    //         $('#editForm').attr('action','products/'+data[0]);
    //         $('#editModal').modal('show');
    //     });
    //     //edit end

    //     //delete
    //     table.on('click','.delete', function(){
    //         $tr=$(this).closest('tr');
    //         if($($tr).hasClass('child')){
    //             $tr=$tr.prev('.parent');
    //         }

    //         var data = table.row($tr).data();
    //         console.log(data);
    //         $('#id').val(data[0])

    //         $('#deleteForm').attr('action','products/'+data[0]);
    //         $('#deleteModal').modal('show');
    //     });
    //     //delete end
    //});


//         $(document).ready(function () {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     $('.create-new-product').click(function () {
//         $('#btn-save').val("create-product");
//         $('#addForm').trigger("reset");
//         //$('#exampleModal').html("Add New product");
//         //$('#exampleModal').modal('show');
//     });

//     $('body').on('click', '#edit-product', function () {
//       var prod_id = $(this).data('id');
//       $.get('products/'+prod_id+'/edit', function (data) {
//          $('#editModal').html("Edit post");
//           $('#btn-save').val("edit-product");
//           $('#editModal').modal('show');
//           //$('#post_id').val(data.id);
//           $('#name').val(data.name);
//           $('#price').val(data.price);
//       })
//    });
//     $('body').on('click', '.delete-product', function () {
//         var prod_id = $(this).data("id");
//         confirm("Are You sure want to delete !");

//         $.ajax({
//             type: "DELETE",
//             url: "{{ url('products')}}"+'/'+prod_id,
//             success: function (data) {
//                 $("#id" + prod_id).remove();
//             },
//             error: function (data) {
//                 console.log('Error:', data);
//             }
//         });
//     });
//   });

//  if ($("#addForm").length > 0) {
//       $("#addForm").validate({

//      submitHandler: function(form) {
//       var actionType = $('#btn-save').val();
//       $('#btn-save').html('Sending..');

//       $.ajax({
//           data: $('#addForm').serialize(),
//           url: "{{ route('products.store') }}",
//           type: "POST",
//           dataType: 'json',
//           success: function (data) {
//               var post = '<tr id="prod_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.body + '</td>';
//               post += '<td><a href="javascript:void(0)" id="edit-product" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
//               post += '<td><a href="javascript:void(0)" id="delete-product" data-id="' + data.id + '" class="btn btn-danger delete-product">Delete</a></td></tr>';


//               if (actionType == "create-product") {
//                   $('#products-crud').prepend(post);
//               } else {
//                   $("#id" + data.id).replaceWith(post);
//               }

//               $('#addForm').trigger("reset");
//               $('#exampleModal').modal('show');
//               $('#btn-save').html('Save Changes');

//           },
//           error: function (data) {
//               console.log('Error:', data);
//               $('#btn-save').html('Save Changes');
//           }
//       });
//     }
//   })
// }


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
                    fetchProducts();
                }
            }


        });
    });


});

</script>
</body>
</html>
