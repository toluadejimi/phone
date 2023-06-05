@extends('layouts.main.app')
@section('head')
@include('layouts.main.headersection',['title'=> __('Dashboard'),'buttons'=>[
]])
@endsection
@section('content')

@if(Auth::user()->updated_at == null)
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Alert!</strong> Please update your password on your profile page . <a class="text-white" href="/user/profile">Click here to update</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif


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

        <p> Welocme to IBDLODED Number site, Get your google voice today</p>
      </div>
      <div class="col-auto">
        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
          <i class="fas fa-server"></i>
        </div>
      </div>
    </div>
  </div>
</div>





<div class="row">

  <div class="col-xl-12">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h3 class="card-title text-uppercase  mb-4">{{ __('Fund your Account') }}</h3>

            <form action="/user/fund-wallet" action="post">
              @csrf

              <div class="col-lg-6">
              <label>Enter amount to fund (NGN)</label>
              <input type="number"  class="form-control my-3" placeholder="Min 100 | Max 1,000,000" name="amount" required autofocus>

           <button

                class="btn btn-neutral my-3"><i class="fas fa-pay"></i> {{ __('Pay Now') }}
                
         
                
              </button> 


              <p>Fund your account instantly</p>
              </div>
            
            
            
            
            
            </form>

             



          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
              <i class="fas fa-server"></i>
            </div>
          </div>
        </div>
      </div>
    </div>











  </div>



  <div class="col-xl-5 col-md-6">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-3">{{ __('Total Logs') }}</h5>

            <h4 class="mb-4">{{ $tc_log }}</h4>


            <div class="row">
              <div class="col">

                <div> <a href="/user/device" class="btn btn-neutral"><i class="fas fa-plus"></i> {{ __('Buy Log') }}</a>
                </div>

              </div>

              <div class="col">

                <div> <a href="/user/logs" class="btn btn-neutral"><i class="fas fa-plus"></i> {{ __('View Log') }}</a>
              
                </div>

              </div>
            </div>


          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
              <i class="ni ni-spaceship"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="row">
  @if(Session::has('success'))
  <div class="col-sm-12">
    <div class="alert bg-gradient-success text-white alert-dismissible fade show success-alert" role="alert">
      <span class="alert-icon"><img src="{{ asset('uploads/firework.png') }}" alt=""></span>
      <span class="alert-text"><strong>{{ __('Congratulations ') }}</strong> {{ Session::get('success') }}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  </div>
  @endif
  @if(Session::has('saas_error'))
  <div class="col-sm-12">
    <div class="alert bg-gradient-primary text-white alert-dismissible fade show" role="alert">
      <a
        href="{{ url(Auth::user()->plan_id == null ? '/user/subscription' : '/user/subscription/'.Auth::user()->plan_id) }}">
        <span class="alert-icon"><i class="fi  fi-rs-info text-white"></i></span>
      </a>
      <span class="alert-text">
        <strong>{{ __('!Opps ') }}</strong>
        <a class="text-white"
          href="{{ url(Auth::user()->plan_id == null ? '/user/subscription' : '/user/subscription/'.Auth::user()->plan_id) }}">
          {{ Session::get('saas_error') }}
        </a>
      </span>
    </div>
  </div>
  @endif
  {{-- <div class="col-sm-6">
    <div class="card">
      <div class="card-header bg-transparent">
        <h4 class="card-header-title">{{ __('Messages Transaction') }}</h4>
        <div class="card-header-action">
          <select class="form-control" id="period">
            <option value="7">{{ __('Last 7 Days') }}</option>
            <option value="1">{{ __('Today') }}</option>
            <option value="30">{{ __('Last 30 Days') }}</option>
          </select>
        </div>
      </div>
      <div class="card-body">
        <!-- Chart -->
        <div class="chart">
          <!-- Chart wrapper -->
          <canvas id="chart-sales" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div> --}}
  <div class="col-sm-6">
    <!--* Card header *-->
    <!--* Card body *-->
    <!--* Card init *-->
    {{-- <div class="card">
      <!-- Card header -->
      <div class="card-header">
        <!-- Surtitle -->
        <h4 class="h3 mb-0 card-header-title">{{ __('Automatic Replies') }}</h4>
        <div class="card-header-action">
          <select class="form-control" id="automaticReply">
            <option value="7">{{ __('Last 7 Days') }}</option>
            <option value="1">{{ __('Today') }}</option>
            <option value="30">{{ __('Last 30 Days') }}</option>
          </select>
        </div>
      </div>
      <!-- Card body -->
      <div class="card-body">
        <div class="chart">
          <!-- Chart wrapper -->
          <canvas id="chart-bars" class="chart-canvas"></canvas>
        </div>
      </div>
    </div> --}}
  </div>

  <div class="col-sm-6">
    <!--* Card header *-->
    <!--* Card body *-->
    <!--* Card init *-->
    {{-- <div class="card">
      <!-- Card header -->
      <div class="card-header">
        <h4 class="h3 mb-0 card-header-title">{{ __('Messages') }}</h4>
        <div class="card-header-action">
          <select class="form-control" id="messagesTypes">
            <option value="7">{{ __('Last 7 Days') }}</option>
            <option value="1">{{ __('Today') }}</option>
            <option value="30">{{ __('Last 30 Days') }}</option>
          </select>
        </div>
      </div>
      <!-- Card body -->
      <div class="card-body">
        <div class="chart">
          <!-- Chart wrapper -->
          <canvas id="chart-doughnut" class="chart-canvas"></canvas>
        </div>
      </div>
    </div> --}}
  </div>

  {{-- <div class="col-sm-6">
    <div class="card">
      <!-- Card header -->
      <div class="card-header bg-transparent">
        <!-- Title -->
        <h4 class="card-header-title">{{ __('Devices Statistics') }}</h4>
      </div>
      <!-- Card body -->
      <div class="card-body">
        <!-- List group -->
        <ul class="list-group list-group-flush list my--3" id="device-list">

        </ul>
      </div>
    </div>
  </div> --}}


</div>


<div class="row">
  <div class="col">
    <div class="card">
      <!-- Card header -->
      <div class="card-header border-0">
        <h3 class="mb-0">{{ __('Latest Transactions') }}</h3>
        <form action="" class="card-header-form">
          <div class="input-group">
            <input type="text" name="search" value="{{ $request->search ?? '' }}" class="form-control"
              placeholder="Search......">
            <select class="form-control" name="type">
              {{-- <option value="email" @if($type=='email' ) selected="" @endif>{{ __('User Email') }}</option>
              <option value="invoice_no" @if($type=='invoice_no' ) selected="" @endif>{{ __('Invoice No') }}</option>
              --}}
            </select>
            <div class="input-group-btn">
              <button class="btn btn-neutral btn-icon"><i class="fas fa-search"></i></button>
            </div>
          </div>
        </form>
      </div>
      <!-- Light table -->
      <div class="table-responsive">
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th class="col-1">{{ __('Customer') }}</th>
              <th class="col-4">{{ __('Amount') }}</th>
              <th class="col-1">{{ __('Type') }}</th>
              <th class="col-1">{{ __('Status') }}</th>
              <th class="col-1 text-left">{{ __('Date') }}</th>
            </tr>
          </thead>
          @if(count($transactions) != 0)
          <tbody class="list">
            @foreach($transactions ?? [] as $trx)
            <tr>
              <td class="">
                {{ $trx->user->name ?? Auth::user()->name }}
              </td>

              <td class="">
                {{ number_format($trx->amount, 2) }}
              </td>

              @if($trx->type == "1")
              <td><span class="badge rounded-pill bg-danger text-white ">Debit</span></td>
              @elseif($trx->type == "2")
              <td><span class="badge rounded-pill bg-success text-white">Credit</span></td>
              @else
              <td><span class="badge rounded-pill bg-warning">Pending</span></td>
              @endif

              @if($trx->status == "2")
              <td><span class="badge rounded-pill bg-danger text-white ">Decline</span></td>
              @elseif($trx->status == "1")
              <td><span class="badge rounded-pill bg-success text-white">Successful</span></td>
              @else
              <td><span class="badge rounded-pill bg-warning">Pending</span></td>
              @endif




              <td class="">
                {{ $trx->created_at->format('d F y') }}
              </td>
            </tr>
            @endforeach
          </tbody>
          @endif
        </table>
        @if(count($transactions) == 0)
        <div class="text-center mt-2">
          <div class="alert  bg-gradient-primary text-white">
            <span class="text-left">{{ __('No Transaction found') }}</span>
          </div>
        </div>
        @endif
      </div>
      <div class="card-footer py-4">
        {{ $transactions->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
      </div>
    </div>
  </div>
</div>


<input type="hidden" id="static-data" value="{{ route('user.dashboard.static') }}">
<input type="hidden" id="base_url" value="{{ url('/') }}">

@endsection
@push('js')
<script src="{{ asset('assets/vendor/chart.js/dist/chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/canvas-confetti/confetti.browser.min.js') }}"></script>
@endpush
@push('bottomjs')
<script src="{{ asset('assets/js/pages/user/dashboard.js') }}"></script>
@endpush