@php
    // dd($product);
    $selected = [];
    if (isset($product)) {
        if ($product->getCategory()->count() > 0) {
            foreach ($product->getCategory as $key => $selectedCategory) {
                $selected[$key] = $selectedCategory['cat_id'];
            }
        }
    }
@endphp
<div id="category" class="tab-pane fade">
    <form class="forms-sample" action="{{ route('add.product.category') }}" method="post">
        @csrf
        @if (isset($product->id))
            <input type="hidden" name="p_id" value="{{ $product->id }}">
        @endif
        <div class="form-group">
            <label for="exampleSelectGender">Category</label>
            <select name="category[]" class="form-control" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (in_array($category->id, $selected)) selected @endif>
                        {{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <button class="btn btn-light">Cancel</button>
    </form>
</div>
