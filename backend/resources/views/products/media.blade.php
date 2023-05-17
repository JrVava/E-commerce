<div id="media" class="tab-pane fade">
    <form class="forms-sample" action="{{ route('upload.product.images') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if (isset($product->uuid))
            <input type="hidden" name="uuid" value="{{ $product->uuid }}">
        @endif
        <div class="form-group">
            <label for="exampleSelectGender">Product Images</label>
            <label class="custom-file form-control" for="product_image">
                <input class="custom-file-input form-control" type="file" id="product_image" name="product_image[]"
                    multiple="" style="display:none">
                <span class="fas fa-folder-open" aria-hidden="true"></span>
                <label class="browser-label" for="product_image">Browser</label>
            </label>
        </div>

        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <button class="btn btn-light">Cancel</button>
    </form>
    <div class="form-group">
        <div id="image_preview">
            @if (isset($product->getProductImage) && $product->getProductImage->count() > 0)
                <div class="row">
                    @foreach ($product->getProductImage as $image)
                        <div class='col-sm-3 img-div' id='img-div'>
                            <img src='{{ url('/') . $image->image }}' class='img-responsive image img-thumbnail'
                                width="200" height="200">
                            <div class="middle">
                                <form
                                    action="{{ route('delete.product.image', ['uuid' => $image->uuid, 'productUUID' => $product->uuid]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="javascript:void(0)" class="btn btn-danger delete-product-image"><i
                                        class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
