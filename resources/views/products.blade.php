<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Products</title>
</head>
<body>

<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                @if(Request::routeIs('edit.product'))
                    <div class="card">
                        <div class="card-header">Edit Product Form</div>

                        <div class="card-body">
                            <form action="{{ route('update.product',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-3">
                                    <label  class="col-md-3 col-form-label">Product Name</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control" required value="{{ $product->name }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Product Code</label>
                                    <div class="col-md-9">
                                        <input type="text" name="code" class="form-control" required value="{{ $product->code }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Product Image</label>
                                    <div class="col-md-9">
                                        <img src="{{ asset($product->image)  }}" alt="" height="150px" width="150px">
                                        <input class="form-control" name="image" accept="image/*" type="file" id="formFile" >
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label"></label>
                                    <div class="col-md-9">
                                        <input class="form-control btn btn-outline-primary" value="Update" type="submit">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                @else
                <div class="card">
                    <div class="card-header">Create Product Form</div>

                    <div class="card-body">
                        <form action="{{ route('store.product') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row mb-3">
                                <label  class="col-md-3 col-form-label">Product Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Product Code</label>
                                <div class="col-md-9">
                                    <input type="text" name="code" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label">Product Image</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="image" accept="image/*" type="file" id="formFile" required>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <input class="form-control btn btn-outline-primary" type="submit">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="py-3 ">
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto ">
                <table class="table">
                    <thead>
                        <tr>
                            <td>SL</td>
                            <td>Name</td>
                            <td>Code</td>
                            <td>Image</td>
                            <td colspan="2">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->code }}</td>
                        <td>
                            <img src="{{ asset($item->image) }}" alt="" height="60px" width="60px">
                        </td>
                        <td>
                            <a href="{{ route('edit.product',$item->id) }}" class="btn btn-sm btn-primary mr-2"> Edit</a>
                            <a href="{{ route('delete.product',$item->id) }}" class="btn btn-sm btn-danger mr-2"> Delete</a>

                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>






<!-- Option 1: Bootstrap Bundle with Popper -->
{{--Sweet Alert--}}
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>
</html>
