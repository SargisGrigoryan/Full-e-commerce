@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="add-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <h2>{{ __('editProduct.new_prod') }}</h2>
                    <hr>
                    <form action="/saveProduct" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <div class="form-group">
                            <label for="input1">{{ __('editProduct.name') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="{{ __('editProduct.product_name') }}" name="name" value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label for="Textarea1">{{ __('editProduct.descr') }}</label>
                            <textarea class="form-control" id="Textarea1" rows="3" placeholder="..." name="descr">{{ $product->descr }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="File1">{{ __('editProduct.gen_image') }}</label>
                            <img src="{{ $product->image }}" alt="Image" class="img-resp">
                            <input type="file" class="form-control-file" id="File1" name="image">
                        </div>
                        <div class="form-group">
                            <label>{{ __('editProduct.gallery') }}</label>
                            <?php
                            $gallery_src_1 = '';
                            $gallery_src_2 = '';
                            $gallery_src_3 = '';

                            if(isset($gallery[0]['src'])){
                                $gallery_src_1 = $gallery[0]['src'];
                            }

                            if(isset($gallery[1]['src'])){
                                $gallery_src_2 = $gallery[1]['src'];
                            }

                            if(isset($gallery[2]['src'])){
                                $gallery_src_3 = $gallery[2]['src'];
                            }
                            
                            ?>
                            <ul>
                                <li><img src="{{ $gallery_src_1 }}" alt="No Image" class="img-gallery"><input type="file" class="form-control-file" name="gallery_image_1"></li>
                                <li><img src="{{ $gallery_src_2 }}" alt="No Image" class="img-gallery"><input type="file" class="form-control-file" name="gallery_image_2"></li>
                                <li><img src="{{ $gallery_src_3 }}" alt="No Image" class="img-gallery"><input type="file" class="form-control-file" name="gallery_image_3"></li>
                            </ul>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">{{ __('editProduct.select_cat') }}</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="cat_id">
                                @foreach ($cats as $cat)
                                    <option value="{{ $cat->id }}" {{ $product->cat_id==$cat->id?'selected':'' }}>{{ $cat->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input3">{{ __('editProduct.colors') }}</label>
                            <input type="text" class="form-control" id="input3" placeholder="{{ __('editProduct.color_placeholder') }}" name="colors" value="{{ $product->colors }}">
                        </div>
                        <div class="form-group">
                            <label for="input4">{{ __('editProduct.display') }}</label>
                            <input type="text" class="form-control" id="input4" placeholder="{{ __('editProduct.display') }}" name="display" value="{{ $product->display }}">
                        </div>
                        <div class="form-group">
                            <label for="input5">{{ __('editProduct.camera') }}</label>
                            <input type="text" class="form-control" id="input5" placeholder="{{ __('editProduct.camera') }}" name="camera" value="{{ $product->camera }}">
                        </div>
                        <div class="form-group">
                            <label for="input6">{{ __('editProduct.memory') }}</label>
                            <input type="text" class="form-control" id="input6" placeholder="{{ __('editProduct.memory') }}" name="memory" value="{{ $product->memory }}">
                        </div>
                        <div class="form-group">
                            <label for="input7">{{ __('editProduct.ram') }}</label>
                            <input type="text" class="form-control" id="input7" placeholder="{{ __('editProduct.ram') }}" name="ram" value="{{ $product->ram }}">
                        </div>
                        <div class="form-group">
                            <label for="input8">{{ __('editProduct.price') }}</label>
                            <input type="number" class="form-control" id="input8" placeholder="{{ __('editProduct.price') }}" min="0" name="price" value="{{ $product->price }}">
                        </div>
                        <div class="form-group">
                            <label for="input9">{{ __('editProduct.discount') }}</label>
                            <input type="number" class="form-control" id="input9" placeholder="{{ __('editProduct.discount') }}" min="0" name="discount" value="{{ $product->discount }}">
                        </div>
                        <div class="form-group">
                            <label for="input9">{{ __('editProduct.in_stock') }}</label>
                            <input type="number" class="form-control" id="input9" placeholder="{{ __('editProduct.in_stock') }}" min="0" name="in_stock" value="{{ $product->in_stock }}">
                        </div>
                        <div class="form-group">
                            <label for="input10">{{ __('editProduct.slider') }}</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="slider" id="exampleRadios1" value="0" {{ $product->slider==0?'checked':'' }}>
                              <label class="form-check-label" for="exampleRadios1">
                                {{ __('editProduct.off') }}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="slider" id="exampleRadios2" value="1" {{ $product->slider==1?'checked':'' }}>
                              <label class="form-check-label" for="exampleRadios2">
                                {{ __('editProduct.on') }}
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="SliderFile1">{{ __('editProduct.slider_image') }}</label>
                          @if ($product->slider == 1)
                            <img src="{{ $product->slider_image }}" alt="Image" class="img-resp">
                          @endif
                          <input type="file" class="form-control-file mt-2" id="SliderFile1" name="slider_image">
                        </div>
                        <div class="form-group">
                            <label for="input10">{{ __('editProduct.top') }}</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="top" id="exampleRadios3" value="0" {{ $product->top==0?'checked':'' }}>
                              <label class="form-check-label" for="exampleRadios3">
                                {{ __('editProduct.off') }}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="top" id="exampleRadios4" value="1" {{ $product->top==1?'checked':'' }}>
                              <label class="form-check-label" for="exampleRadios4">
                                {{ __('editProduct.on') }}
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input11">{{ __('editProduct.status') }}</label>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios5" value="0" {{ $product->status==0?'checked':'' }}>
                              <label class="form-check-label" for="exampleRadios5">
                                {{ __('editProduct.hidden') }}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="status" id="exampleRadios6" value="1" {{ $product->status==1?'checked':'' }}>
                              <label class="form-check-label" for="exampleRadios6">
                                {{ __('editProduct.public') }}
                              </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('editProduct.save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    {{-- Register ssection end --}}

@endsection