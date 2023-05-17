@extends('layouts.app')

@section('title', 'Category')
@section('content')

    <div class="panel-heading">Manage Category</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <h3>Category List</h3>
                <ul id="tree1">
                    @foreach ($categories as $category)
                        <li>
                            {{ $category->title }} ({{ $category->countProductLinkWithCategory()->count() }}) <i class="fas fa-plus category-event"
                                onClick="addOrUpdateCategory({{ $category->id }},'add')"></i>
                            @if (count($category->childs))
                                @include('manageChild', ['childs' => $category->childs])
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6 category-form">
                <h3>Add New Category</h3>
                <form action="{{ route('add.category') }}" method="post">
                    @csrf
                    <input type="hidden" name="parent_id" id="parent_id">
                    <input type="hidden" name="id" id="cat_id">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label>Title</label>
                        <input type="text" value="{{ old('title') }}" class="form-control" name="title"
                            placeholder='Enter Title' id="title" />
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteCategory(id) {
            Swal.fire({
                title: 'Are you sure you want to delete this category?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('category.delete') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id
                        },
                        success: function(res) {
                            if (res.status) {
                                Swal.fire('Deleted!', res.message).then((response) => {
                                    location.reload(true);
                                })
                            }
                        }
                    });

                }
            })
        }

        function addOrUpdateCategory(id, methodType) {
            $('#parent_id').val("")
            $('#title').val("")
            $('#cat_id').val("")
            if (methodType == "edit") {
                $('#parent_id').val("")
                $.ajax({
                    url: `{{ url('category/edit') }}/${id}`,
                    type: "GET",
                    success: function(res) {
                        $('#title').val(res.category.title)
                        $('#parent_id').val(res.category.parent_id)
                        $('#cat_id').val(res.category.id)
                    }
                })
            }else{
                $('#parent_id').val(id)
            }
            $('.category-form').css('display', 'block');
        }
    </script>
@endsection
