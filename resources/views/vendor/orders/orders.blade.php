@extends('vendor.vendor_master')


@section('vendor')
{{-- <h1>Manage Products by Vendor</h1> --}}
<!-- Navbar -->
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Orders</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Orders</h6>
    </nav>
  </div>
</nav>
<!-- End Navbar -->

<br>

<div class="container-fluid py-4">

   <div class="col-12">
      <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
            <h6 class="text-white text-capitalize ps-3">Orders table</h6>
          </div>
        </div>
         <div class="card-body px-0 pb-2">
      
       {{-- Add Products --}}
      
          <!-- Link to add products -->
          <a href="{{ route('vendor.add.products') }}" style="color: white"><button style="width: 40%; margin: 20px 0 20px 10px" type="button" class="btn btn-success">Add New Products</button>
          </a>

          <br>

         {{-- <span class="badge rounded-pill bg-info" style="width: 30%; margin-left:20px">Total Products: {{ count($products)}}</span>    --}}

      <div class="card-footer p-3">
        {{-- datatable --}}
        <div class="card-body px-0 pb-2">
          <table id="dataTable" class="table table-striped" style="width:auto">
              <thead>
                  <tr>
                    <th>No.</th>
                    <th style="text-align: center">Name</th>
                    <th >Invoice No.</th>
                    <th>Amount(RM)</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                      
                  </tr>
              </thead>
              <tbody>
                    @foreach ($orderItems as $order)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      {{-- <td class="text-capitalize">{{ $order->order_date }}</td> --}}
                      <td class="text-capitalize">{{ $order['order']->firstName }}</td>
                      <td class="text-capitalize">{{ $order['order']->invoice_number }}</td>
                      <td class="text-capitalize">RM{{ $order['order']->amount }}</td>
                      <td class="text-capitalize">{{ $order->quantity }}</td>
                      <td>
                         <span class="badge rounded-pill bg-warning">{{ $order['order']->status }}</span>
                     </td>
                     <td>{{ date('F j, Y', strtotime($order['order']->order_date)) }}</td>
                     <td>
                       <a href="" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="See this orders details"><i class="fa-solid fa-eye"></i></a>
              
                         
                      </td>
                  </tr>
                    
                    @endforeach  
              </tbody>
          </table>
        </div> 
      </div>
    </div>
         
      </div>
    </div>
  
   
    
</div>




@endsection
