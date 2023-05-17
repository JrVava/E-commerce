@extends('layouts.app')

@section('title', 'Product Form')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#product">Product</a></li>
        <li><a data-toggle="tab" href="#media">Media</a></li>
        <li><a data-toggle="tab" href="#category">Category</a></li>
    </ul>

    <div class="tab-content">
        @include('products.basic')
        @include('products.media')
        @include('products.category')
    </div>
    <script type="text/javascript">
        ClassicEditor.create(document.querySelector("#short_des"));
        ClassicEditor.create(document.querySelector("#long_des"));
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                let nameLowerCase = this.value.toLowerCase();
                let sku = nameLowerCase.replace(/ /g, "-");
                $('#sku').val(sku);
            });

            var fileArr = [];
            $("#product_image").change(function() {
                // check if fileArr length is greater than 0
                let html = '<div class="row">';
                if (fileArr.length > 0) fileArr = [];

                // $('#image_preview').html("");
                var total_file = document.getElementById("product_image").files;
                if (!total_file.length) return;

                for (var i = 0; i < total_file.length; i++) {
                    if (total_file[i].size > 1048576) {
                        return false;
                    } else {
                        fileArr.push(total_file[i]);

                        html += `<div class='col-sm-3 img-div' id='img-div${i}'>`;
                        html +=
                            `<img src='${URL.createObjectURL(event.target.files[i])}' class='img-responsive image img-thumbnail' title='${total_file[i].name}' width="200" height="200">`;
                        html += '<div class="middle">';
                        html +=
                            `<button id='action-icon' value='img-div${i}' class='btn btn-danger' role='${total_file[i].name}'>`;
                        html += '<i class="fas fa-trash"></i>';
                        html += '</button>';
                        html += '</div>';
                        html += '</div>';

                    }
                }
                html += '</div>';
                $('#image_preview').append(html);
            });

            $('body').on('click', '#action-icon', function(evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById('product_image').files = FileListItem(fileArr);
                evt.preventDefault();
            });

            $('body').on('click','.delete-product-image',function(){
                Swal.fire({
                    title: 'Are you sure you want to delete this product?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: `Save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).prev().submit();
                    }
                })
            })
        });
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif
        function FileListItem(file) {
            file = [].slice.call(Array.isArray(file) ? file : arguments)
            for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
            if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
            for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
            return b.files
        }

    </script>
@endsection
