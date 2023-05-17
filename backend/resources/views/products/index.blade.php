@extends('layouts.app')

@section('title', 'Product List')
@section('content')
    <a href="{{ route('product.create') }}" class="btn btn-success" style="margin-bottom: 10px;">Add Product</a>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Sku</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <script type="text/javascript">
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        $(function() {

            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'sku',
                        name: 'sku'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            $('body').on('click', '.delete-product', function() {
                Swal.fire({
                    title: 'Are you sure you want to delete this product?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().submit();
                    }
                })
            })
        });
    </script>
@endsection
