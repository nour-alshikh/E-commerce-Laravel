      <footer>
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                   <div class="full">
                      <div class="logo_footer">
                        <a href="#"><img width="210" src="/images/logo.png" alt="#" /></a>
                      </div>
                      <div class="information_f">
                        <p><strong>ADDRESS:</strong> 28 White tower, Street Name New York City, USA</p>
                        <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                        <p><strong>EMAIL:</strong> yourmain@gmail.com</p>
                      </div>
                   </div>
               </div>
               <div class="col-md-8">
                  <div class="row">
                  <div class="col-md-7">
                     <div class="row">
                        <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Menu</h3>
                        <ul>
                           <li><a href="{{ url('/') }}">Home</a></li>
                           <li><a href="{{ url('show_test') }}">Testimonial</a></li>
                           <li><a href="{{ url('show_blog') }}">Blog</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Account</h3>
                        <ul>
                            @if(!Auth::id())
                           <li><a href="{{ url('log_in') }}">Login</a></li>
                           <li><a href="{{ url('subscribe') }}">Register</a></li>
                           @endif
                           <li><a href="{{ url('show_products') }}">Shopping</a></li>
                           <li><a href="{{ url('show_cart') }}">Cart</a></li>
                           <li><a  href="{{ url('show_order') }}">Order</a></li>
                        </ul>
                     </div>
                  </div>
                     </div>
                  </div>
                  @if(!Auth::id())
                  <div class="col-md-5">
                     <div class="widget_menu">
                        <h3>Newsletter</h3>
                        <div class="information_f">
                          <p>Subscribe by our newsletter and get update protidin.</p>
                        </div>
                        <div class="form_sub">
                           <form  action="{{ url('subscribe') }}" method="GET">
                            @csrf
                              <fieldset>
                                 <div class="field">
                                    <input type="email" placeholder="Enter Your Mail" name="email" />
                                    <input type="submit" value="Subscribe" />
                                 </div>
                              </fieldset>
                           </form>
                        </div>
                    </div>
                </div>
                @endif
                  </div>
               </div>
            </div>
         </div>
      </footer>
