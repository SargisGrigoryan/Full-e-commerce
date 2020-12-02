@extends('layout')

@section('content')

    {{-- Cart --}}
    <section id="cart">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Your cart list</h2>
                </div>

                <div class="col-12 mt-3">
                    <table class="table">
                        <tbody>
                          <tr>
                            <th scope="row">
                                <div class="cart-image">
                                    <a href="/details">
                                        <img src="https://icdn2.digitaltrends.com/image/aem/aem-2020-7-3-dc6bd6650daf4630691cbe11c37b7b42bf0a30e9-500x500.png" alt="Image" class="img-resp">
                                    </a>
                                </div>
                            </th>
                            <td>Product name</td>
                            <td>
                                <div class="cart-descr">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                    Nobis omnis expedita et distinctio, quis excepturi fugit 
                                    natus officiis sequi fugiat quos nesciunt tempora, in ea 
                                    labore voluptatum commodi laudantium similique.
                                </div>
                            </td>
                            <td>$150</td>
                            <td>
                                <button class="btn btn-success"><i class="fas fa-shopping-cart"></i></button>
                                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </td>
                          </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    {{-- Cart end --}}

@endsection