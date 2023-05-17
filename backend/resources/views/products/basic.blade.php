{{-- @php
    dd($errors); 
@endphp   --}}
<div id="product" class="tab-pane fade in active">
    <form method="post" action="{{ route('add.product') }}">
        @csrf
        @if(isset($product->uuid))
        <input type="hidden" name="uuid" value="{{ $product->uuid }}">
        <input type="hidden" name="id" value="{{ $product->id }}">
        @endif
        <div class="form-group">
            <label for="product" class="control-label">Status</label>
            <select name="status" class="form-control">
                <option value="1" @if(isset($product->status) && $product->status == 1) selected  @endif>Active</option>
                <option value="0" @if(isset($product->status) && $product->status == 0) selected @endif>Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="product" class="control-label">In Stock</label>
            <select name="in_stock" class="form-control">
                <option value="1" @if(isset($product->in_stock) && $product->in_stock == 1) selected @endif>Yes</option>
                <option value="0" @if(isset($product->in_stock) && $product->in_stock == 0) selected @endif>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="product" class="control-label">Name</label>
            <input type="text" class="form-control" placeholder="Enter Product Name" name="name" id="name" value="@if(isset($product->name)){{ $product->name }}@else{{ old('name') }}@endif">
            @if ($errors->has('name'))
                <span class="error">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="product" class="control-label">Sku</label>
            <input type="text" class="form-control" placeholder="Enter Sku" id="sku" name="sku" value="@if(isset($product->sku)){{ $product->sku }}@else{{ old('sku') }}@endif">
            @if ($errors->has('sku'))
                <span class="error">{{ $errors->first('sku') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="product" class="control-label">Price</label>
            <input type="text" class="form-control" placeholder="Enter Price" id="price" name="price" value="@if(isset($product->price)){{ $product->price }}@else{{ old('price') }}@endif">
        </div>
        <div class="form-group">
            <label for="product" class="control-label">Short Description</label>
            <textarea id="short_des" name="short_decription" placeholder="Short Description">@if(isset($product->short_decription)){{ $product->short_decription }}@else{{ old('short_decription') }}@endif</textarea>
        </div>
        <div class="form-group">
            <label for="product" class="control-label">Long Description</label>
            <textarea id="long_des" name="long_decription" placeholder="Long Description">@if(isset($product->long_decription)){{ $product->long_decription }}@else{{ old('long_decription') }}@endif</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('product') }}" class="btn btn-danger">Back</a>
    </form>
</div>
