@extends('products.layout')
     
@section('content')

<div class="card mt-5">
  <h2 class="card-header">Tugas PPW API</h2>
  <div class="card-body">
          
        @session('success')
            <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('products.create') }}"> <i class="fa fa-plus"></i> Create New Product</a>
        </div>
  
        <table class="table table-bordered table-striped mt-4" id="productTable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th width="250px">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data Produk Akan Dimuat Disini -->
            </tbody>
        </table>
  
        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}

  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Fetch data from API
    fetch("{{ url('api/products') }}")
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#productTable tbody');
            tableBody.innerHTML = ""; // Kosongkan table sebelum mengisi data
            data.data.forEach((product, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td><img src="${product.image}" width="100px"></td>
                    <td>${product.name}</td>
                    <td>${product.detail}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/products/${product.id}/edit">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="/products/${product.id}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
</script>

@endsection
