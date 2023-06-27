@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',[
'title'=>__('Buy Log'),
'buttons'=>[
[

]
]])
@endsection
@section('content')
<div class="row justify-content-center">
   <div class="col-12">


      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      @if (session()->has('message'))
      <div class="alert alert-success">
          {{ session()->get('message') }}
      </div>
      @endif
      @if (session()->has('error'))
      <div class="alert alert-danger">
          {{ session()->get('error') }}
      </div>
      @endif
      
      
      <div class="card card-stats">
         <!-- Card body -->
         <div class="card-body">
            <div class="row">
               <div class="col">
                 
                  <h5 class="card-title text-uppercase text-muted mb-2">Welcome {{ Auth::user()->name }}, </h5>

                  <p> Buy Google Voice, Talkatone, Text-Now etc logs now</p>
               </div>
               <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                     <i class="fas fa-server"></i>
                  </div>
               </div>
            </div>
         </div>
      </div>



      <!-- <div class="row"> -->


         <div class="col-xl-12 col-md-6">

         
            <div class="card card-stats">
               <!-- Card body -->
               <div class="card-body">
               <center><a href="https://dashboard.oprime.com.ng/user/device"> <div class="alert alert-success" role="alert"><marquee>  😍 <b><font color="black">GMAIL GV #2,000, DOMAIN GV:#900, TALKATONE: #1,3000, TEXTNOW: NOT AVAILABLE, TWITTER 12 YEARS: #800, NETFLIX: #900, waseunfunmi01.
         </font></b> 😍 <a href="https://dashboard.oprime.com.ng/user/device"> <button type="button" class="btn btn-success"> Order Now ▶ </button></a>
          </marquee></div></a></center>  
                  <h4 class=" mb-5 my-3">Buy Google Voice/ Textnow & Talkatone Log</h4>


                  <form action="buy-now" method="post">
                     @csrf 

                     <div class="row">

                     <div class="col-xl-6 col-md-6">
                        <div class="form-group mb-3">
                           <label>Choose Item</label>
                           <select id="country-dropdown"  required name="product" class="form-control">
                              <option value="">-- Select Item --</option>
                              @foreach ($products as $data)
                              <option value="{{$data->item_id}}">
                                 {{$data->item_name}}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </div>

                     <div class="col-xl-6 col-md-6">


                        <div class="form-group mb-3">
                           <label>Choose Area Code</label>
                           <select id="state-dropdown" rwquired name="area_code" class="form-control">
                           </select>



                        </div>

                     </div>
                     <div class="col-xl-6 col-md-6">


                     
                        <div class="form-group">
                           <label>Amount (NGN)</label>
                           <select id="city-dropdown" required name="amount" class="form-control">
                           </select>
                        </div>
                        

                     </div>

                     {{-- <div class="col-xl-6 col-md-6">


                        <div class="form-group mb-3">
                           <label>Quantity</label>
                           <input type="number" name="qty[]" id="qty" value="1" required class="form-control">
                           </select>
                        </div>

                     </div> --}}

                     <div class="col-xl-6 col-md-6">

                       {{-- <div class="my-1">
                           <p >Total Price: <strong id="totalPrice">NGN 0</strong></p>
                        </div> --}}

                        <div>
                           <button type="submit" class="btn btn-outline-primary my-4 submit-button float-left">{{ __('Buy Now') }}</button>
                        </div>
                     </div>

                  
                  </div>

                  </form>

                  <div>
  <button style="background-color: green; padding:6px; border:none; border-radius:10px" type="button"><a style="color: white;" href="https://oprime.com.ng/wordpress/our-rules">CLICK HERE TO READ OUR RULES</a></button>
</div>

                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                  <script>
                     $(document).ready(function () {
                     
                               /*------------------------------------------
                               --------------------------------------------
                               Country Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#country-dropdown').on('change', function () {
                                   var item_id = this.value;
                                   $("#state-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-code')}}",
                                       type: "POST",
                                       data: {
                                            item_id: item_id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (result) {
                                          console.log(result)
                                           $('#state-dropdown').html('<option value="">-- Select Area Code --</option>');
                                           $.each(result.states, function (key, value) {
                                               $("#state-dropdown").append('<option value="' + value
                                                   .id + '">' + value.area_code + '</option>');
                                           });
                                           $('#city-dropdown').html('<option value="">-- Amount --</option>');
                                       }
                                   });
                               });
                     
                               /*------------------------------------------
                               --------------------------------------------
                               State Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#state-dropdown').on('change', function () {
                                   var id = this.value;
                                   $("#city-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-amount')}}",
                                       type: "POST",
                                       data: {
                                           id: id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (res) {
                                          console.log(res)
                                           $('#city-dropdown').html(res.price);
                                           $.each(res.cities, function (key, value) {
                                               $("#city-dropdown").append('<option value="' + value.price + '">' + value.price + '</option>');
                                           });
                                       }
                                   });
                               });
                     
                           });
                  </script>


                  <script>
                     var quantityInput = document.getElementById("qty");
                     var totalPriceElement = document.getElementById("totalPrice");
                     var amount = document.getElementById("city-dropdown");

                 
                     quantityInput.addEventListener("change", updateTotalPrice);
                 
                     function updateTotalPrice() {
                       var quantity = parseInt(quantityInput.value);
                       var price = parseInt(amount.value); // Example price per item
                       var totalPrice = quantity * price;
                       console.log(totalPrice);
                       console.log(price);
                       console.log(amount);

                       totalPriceElement.textContent = "NGN " + totalPrice;
                     }
                  </script>



               </div>
            </div>
         </div>

         {{-- <div class="col-xl-6 col-md-6">


            <div class="card card-stats">
               <!-- Card body -->
               <div class="card-body">
                  <div class="row">
                     <div class="col">

                        <h4 class=" mb-5 my-3">Buy Netflix Log</h4>


                        <form>

                           <div class="form-group mb-3">

                              <label>Choose Item</label>
                              <select id="netp" class="form-control">
                                 <option value="">-- Select Item --</option>
                                 @foreach ($netflix_p as $data)
                                 <option value="{{$data->item_id}}">
                                    {{$data->item_name}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>

                           <div class="form-group mb-3">
                              <label>Amount (NGN)</label>
                              <select id="net-amount" class="form-control">
                              </select>
                           </div>

                           <div class="form-group mb-3">
                              <label>Quantity</label>
                              <input type="number" name="qty" id="qty" value="1" required class="form-control">
                              </select>
                           </div>

                        </form>


                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                           $(document).ready(function () {
                     
                               /*------------------------------------------
                               --------------------------------------------
                               Country Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#netp').on('change', function () {
                                   var item_id = this.value;
                                   $("#net-amount").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-code')}}",
                                       type: "POST",
                                       data: {
                                            item_id: item_id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (result) {
                                          console.log(result)
                                           $('#net-amount').html(result.price);
                                           $.each(result.states, function (key, value) {
                                               $("#net-amount").append('<option value="' + value
                                                   .id + '">' + value.price + '</option>');
                                           });
                                           $('#city-dropdown').html('<option value="">-- Amount --</option>');
                                       }
                                   });
                               });
                     
                               /*------------------------------------------
                               --------------------------------------------
                               State Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#state-dropdown').on('change', function () {
                                   var id = this.value;
                                   $("#city-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-amount')}}",
                                       type: "POST",
                                       data: {
                                           id: id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (res) {
                                          console.log(res)
                                           $('#city-dropdown').html(res.price);
                                           $.each(res.cities, function (key, value) {
                                               $("#city-dropdown").append('<option value="' + value
                                                   .id + '">' + value.price + '</option>');
                                           });
                                       }
                                   });
                               });
                     
                           });
                        </script>


                     </div>
                     <div class="col-auto">


                     </div>
                  </div>
               </div>



            </div>


         </div> --}}

      </div>



   </div>


   
<div style="background-color: green;">
    <h3 style="color: red;"><strong>Note: Domain Gv is not Working for whatsapp again</strong></h3>
    <br>
    <p style="color: white;">Terms: All logs uploaded to our platform undergo testing before being uploaded. Therefore, we only replace logs if the password is incorrect. Replacement is done within 1 hour of the logs being in your hands.</p><br>

    <p style="color: white;">Logs we replace: Gmail Google voice, TEXTNOW, Domain Google voice, Talkatone</p><br>
    <p style="color: white;">Knowledge: If you receive TEXTNOW logs, try logging in directly from the TEXTNOW App or login using your Google account.</p><br>
    <p style="color: white;">If your Gmail Google Voice account gets disabled, kindly request a review from Google. They will unblock it for you within 1 to 2 days.</p><br>
</div>

</div>

<input type="hidden" id="base_url" value="{{ url('/') }}">
@endsection
@push('js')
<script src="{{ asset('assets/js/pages/user/device.js') }}"></script>
@endpush