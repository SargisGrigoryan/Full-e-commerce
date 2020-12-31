@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="add-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <h2>{{ __('addProduct.new_prod') }}</h2>
                    <hr>
                    <form action="addProduct" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="input1">{{ __('addProduct.name') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="{{ __('addProduct.product_name') }}" name="name">
                        </div>
                        <div class="form-group">
                            <label for="Textarea1">{{ __('addProduct.descr') }}</label>
                            <textarea class="form-control" id="Textarea1" rows="3" placeholder="..." name="descr"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="File1">{{ __('addProduct.gen_image') }}</label>
                            <input type="file" class="form-control-file" id="File1" name="image">
                        </div>
                        <div class="form-group">
                            <label>{{ __('addProduct.gallery') }}</label>
                            <input type="file" class="form-control-file" name="gallery_image_1"> <br>
                            <input type="file" class="form-control-file" name="gallery_image_2"> <br>
                            <input type="file" class="form-control-file" name="gallery_image_3"> <br>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">{{ __('addProduct.select_cat') }}</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="cat_id">
                                <option selected>...</option>
                                @foreach ($data as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input3">{{ __('addProduct.colors') }}</label>
                            <input type="text" class="form-control" id="input3" placeholder="{{ __('addProduct.color_placeholder') }}" name="colors">
                        </div>
                        <div class="form-group">
                            <label for="input4">{{ __('addProduct.display') }}</label>
                            <input type="text" class="form-control" id="input4" placeholder="{{ __('addProduct.display') }}" name="display">
                        </div>
                        <div class="form-group">
                            <label for="input5">{{ __('addProduct.camera') }}</label>
                            <input type="text" class="form-control" id="input5" placeholder="{{ __('addProduct.camera') }}" name="camera">
                        </div>
                        <div class="form-group">
                            <label for="input6">{{ __('addProduct.memory') }}</label>
                            <input type="text" class="form-control" id="input6" placeholder="{{ __('addProduct.memory') }}" name="memory">
                        </div>
                        <div class="form-group">
                            <label for="input7">{{ __('addProduct.ram') }}</label>
                            <input type="text" class="form-control" id="input7" placeholder="{{ __('addProduct.ram') }}" name="ram">
                        </div>
                        <div class="form-group">
                            <label for="input8">{{ __('addProduct.price') }}</label>
                            <input type="number" class="form-control" id="input8" placeholder="{{ __('addProduct.price') }}" min="0" name="price">
                        </div>
                        <div class="form-group">
                            <label for="input9">{{ __('addProduct.discount') }}</label>
                            <input type="number" class="form-control" id="input9" placeholder="{{ __('addProduct.discount') }}" min="0" value="0" name="discount">
                        </div>
                        <div class="form-group">
                            <label for="input9">{{ __('addProduct.in_stock') }}</label>
                            <input type="number" class="form-control" id="input9" placeholder="{{ __('addProduct.in_stock') }}" min="0" value="0" name="in_stock">
                        </div>
                        <div class="form-group">
                            <label for="input10">{{ __('addProduct.slider') }}</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="slider" id="exampleRadios1" value="0" checked>
                              <label class="form-check-label" for="exampleRadios1">
                                {{ __('addProduct.off') }}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="slider" id="exampleRadios2" value="1">
                              <label class="form-check-label" for="exampleRadios2">
                                {{ __('addProduct.on') }}
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="SliderFile1">{{ __('addProduct.slider_image') }}</label>
                          <input type="file" class="form-control-file" id="SliderFile1" name="slider_image">
                        </div>
                        <div class="form-group">
                            <label for="input10">{{ __('addProduct.top') }}</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="top" id="exampleRadios3" value="0" checked>
                              <label class="form-check-label" for="exampleRadios3">
                                {{ __('addProduct.off') }}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="top" id="exampleRadios4" value="1">
                              <label class="form-check-label" for="exampleRadios4">
                                {{ __('addProduct.on') }}
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input11">{{ __('addProduct.status') }}</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios5" value="0">
                              <label class="form-check-label" for="exampleRadios5">
                                {{ __('addProduct.hidden') }}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios6" value="1" checked>
                              <label class="form-check-label" for="exampleRadios6">
                                {{ __('addProduct.public') }}
                              </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('addProduct.add') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Register ssection end --}}

@endsection