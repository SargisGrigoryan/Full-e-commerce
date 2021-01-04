@extends('layout')

@section('content')

    {{-- Register ssection --}}
    <section id="add-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 ml-auto mr-auto">
                    <h2>{{ __('editProduct.edit_prod') }}</h2>
                    <hr>
                    <form action="/saveProduct" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="id">
                        <div class="form-group">
                            <label for="input1">{{ __('editProduct.name_en') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="{{ __('editProduct.product_name') }}" name="name_en" value="{{ $product->name_en }}">
                        </div>
                        <div class="form-group">
                            <label for="input1">{{ __('editProduct.name_ru') }}</label>
                            <input type="text" class="form-control" id="input1" placeholder="{{ __('editProduct.product_name') }}" name="name_ru" value="{{ $product->name_ru }}">
                        </div>
                        <div class="form-group">
                            <label for="Textarea1">{{ __('editProduct.descr_en') }}</label>
                            <textarea class="form-control" id="Textarea1" rows="3" placeholder="..." name="descr_en">{{ $product->descr_en }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="Textarea1">{{ __('editProduct.descr_ru') }}</label>
                            <textarea class="form-control" id="Textarea1" rows="3" placeholder="..." name="descr_ru">{{ $product->descr_ru }}</textarea>
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
                            <label for="input3">{{ __('editProduct.colors_en') }}</label>
                            <input type="text" class="form-control" id="input3" placeholder="{{ __('editProduct.color_placeholder') }}" name="colors_en" value="{{ $product->colors_en }}">
                        </div>
                        <div class="form-group">
                            <label for="input3">{{ __('editProduct.colors_ru') }}</label>
                            <input type="text" class="form-control" id="input3" placeholder="{{ __('editProduct.color_placeholder') }}" name="colors_ru" value="{{ $product->colors_ru }}">
                        </div>
                        <div class="form-group">
                            <label for="input4">{{ __('editProduct.display_en') }}</label>
                            <input type="text" class="form-control" id="input4" placeholder="{{ __('editProduct.display_en') }}" name="display_en" value="{{ $product->display_en }}">
                        </div>
                        <div class="form-group">
                            <label for="input4">{{ __('editProduct.display_ru') }}</label>
                            <input type="text" class="form-control" id="input4" placeholder="{{ __('editProduct.display_ru') }}" name="display_ru" value="{{ $product->display_ru }}">
                        </div>
                        <div class="form-group">
                            <label for="input5">{{ __('editProduct.camera_en') }}</label>
                            <input type="text" class="form-control" id="input5" placeholder="{{ __('editProduct.camera_en') }}" name="camera_en" value="{{ $product->camera_en }}">
                        </div>
                        <div class="form-group">
                            <label for="input5">{{ __('editProduct.camera_ru') }}</label>
                            <input type="text" class="form-control" id="input5" placeholder="{{ __('editProduct.camera_ru') }}" name="camera_ru" value="{{ $product->camera_ru }}">
                        </div>
                        <div class="form-group">
                            <label for="input6">{{ __('editProduct.memory_en') }}</label>
                            <input type="text" class="form-control" id="input6" placeholder="{{ __('editProduct.memory_en') }}" name="memory_en" value="{{ $product->memory_en }}">
                        </div>
                        <div class="form-group">
                            <label for="input6">{{ __('editProduct.memory_ru') }}</label>
                            <input type="text" class="form-control" id="input6" placeholder="{{ __('editProduct.memory_ru') }}" name="memory_ru" value="{{ $product->memory_ru }}">
                        </div>
                        <div class="form-group">
                            <label for="input7">{{ __('editProduct.ram_en') }}</label>
                            <input type="text" class="form-control" id="input7" placeholder="{{ __('editProduct.ram_en') }}" name="ram_en" value="{{ $product->ram_en }}">
                        </div>
                        <div class="form-group">
                            <label for="input7">{{ __('editProduct.ram_ru') }}</label>
                            <input type="text" class="form-control" id="input7" placeholder="{{ __('editProduct.ram_ru') }}" name="ram_ru" value="{{ $product->ram_ru }}">
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