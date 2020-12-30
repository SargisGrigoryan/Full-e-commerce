@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="add-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <h2>Add new product</h2>
                    <hr>
                    <form action="addProduct" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="input1">Name</label>
                            <input type="text" class="form-control" id="input1" placeholder="Product Name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="Textarea1">Description</label>
                            <textarea class="form-control" id="Textarea1" rows="3" placeholder="..." name="descr"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="File1">General image</label>
                            <input type="file" class="form-control-file" id="File1" name="image">
                        </div>
                        <div class="form-group">
                            <label>Gallery</label>
                            <input type="file" class="form-control-file" name="gallery_image_1"> <br>
                            <input type="file" class="form-control-file" name="gallery_image_2"> <br>
                            <input type="file" class="form-control-file" name="gallery_image_3"> <br>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Select Category</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="cat_id">
                                <option selected>...</option>
                                @foreach ($data as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input3">Colors</label>
                            <input type="text" class="form-control" id="input3" placeholder="colors" name="colors">
                        </div>
                        <div class="form-group">
                            <label for="input4">Display</label>
                            <input type="text" class="form-control" id="input4" placeholder="display" name="display">
                        </div>
                        <div class="form-group">
                            <label for="input5">Camera</label>
                            <input type="text" class="form-control" id="input5" placeholder="camera" name="camera">
                        </div>
                        <div class="form-group">
                            <label for="input6">Memory</label>
                            <input type="text" class="form-control" id="input6" placeholder="memory" name="memory">
                        </div>
                        <div class="form-group">
                            <label for="input7">RAM</label>
                            <input type="text" class="form-control" id="input7" placeholder="ram" name="ram">
                        </div>
                        <div class="form-group">
                            <label for="input8">Price</label>
                            <input type="number" class="form-control" id="input8" placeholder="price" min="0" name="price">
                        </div>
                        <div class="form-group">
                            <label for="input9">Discount</label>
                            <input type="number" class="form-control" id="input9" placeholder="discount" min="0" value="0" name="discount">
                        </div>
                        <div class="form-group">
                            <label for="input9">In stock</label>
                            <input type="number" class="form-control" id="input9" placeholder="discount" min="0" value="0" name="in_stock">
                        </div>
                        <div class="form-group">
                            <label for="input10">Slider</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="slider" id="exampleRadios1" value="0" checked>
                              <label class="form-check-label" for="exampleRadios1">
                                OFF
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="slider" id="exampleRadios2" value="1">
                              <label class="form-check-label" for="exampleRadios2">
                                ON
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="SliderFile1">Slider image</label>
                          <input type="file" class="form-control-file" id="SliderFile1" name="slider_image">
                        </div>
                        <div class="form-group">
                            <label for="input10">TOP</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="top" id="exampleRadios3" value="0" checked>
                              <label class="form-check-label" for="exampleRadios3">
                                OFF
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="top" id="exampleRadios4" value="1">
                              <label class="form-check-label" for="exampleRadios4">
                                ON
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input11">Status</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios5" value="0">
                              <label class="form-check-label" for="exampleRadios5">
                                Hidden
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios6" value="1" checked>
                              <label class="form-check-label" for="exampleRadios6">
                                Public
                              </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Register ssection end --}}

@endsection