      <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
               <form action="{{url('search_product')}}" method="GET" class="my-4">
                @csrf
                <input type="text" name="search" style="width: 500px; text-align:center" placeholder="Search...." />
                <input type="submit" value="Search" />
               </form>
            </div>
            <div class="row">
                @forelse($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{ url('product_details' , $product->id) }}" class="option1">
                           Details
                           </a>

                           <form method="POST" action="{{ url('add_cart' , $product->id) }}">
                            @csrf
                             <div class="row align-items-center">
                                <div class="col-md-4">
                                    <input type="number" style="width: 100px; margin: 0; " min="1" value="1" name="quantity" />
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" value="Add to cart"/>
                                </div>
                             </div>
                            </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="/products/{{ $product->image }}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{ $product->title }}
                        </h5>
                        @if($product->discount_price != 0)
                        <h6 style="color: red; font-size: 20px;">
                           ${{ $product->discount_price }}
                        </h6>
                        <h6 style="text-decoration: line-through; opacity: 0.7; font-size: 20px;">
                           ${{ $product->price }}
                        </h6>
                        @else
                        <h6 style="opacity: 0.7; font-size: 20px;">
                           ${{ $product->price }}
                        </h6>
                        @endif
                     </div>
                  </div>
                </div>

                @empty
                <h1 class="text-danger m-auto" style="font-size: 25px; text-align: center;">No Data Found</h1>

                @endforelse
            </div>
            <span style="padding: 20px; width: 500px;">
            {!!$products->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
            <div class="btn-box">
               <a href="{{ url('show_products') }}">
               View All products
               </a>
            </div>
         </div>
      </section>
