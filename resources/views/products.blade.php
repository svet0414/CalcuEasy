<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CalcuEasy</title>
</head>
<body>
     <!-- Modal -->
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

      <table class="table table-bordered table-hover">
        <thead>
          <tr>

            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Actons</th>
          </tr>
        </thead>
        <tbody>
           @foreach ($products as $prodData )


          <tr>
            <td>{{$prodData->name}}</td>
            <td>{{$prodData->price}} dkk</td>
            <td>kur</td>
          </tr>
          @endforeach
        </tbody>
      </table>

</div>

<!-- Button trigger modal -->



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
