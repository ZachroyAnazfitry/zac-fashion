@extends('admin.admin_master')

@section('admin')

<!-- Navbar -->
 <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Orders Details</li>
      </ol>
      <h6 class="font-weight-bolder mb-0">Orders Details</h6>
    </nav>
  </div>
</nav>

<br>

<div class="container-fluid py-4">

  <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
    <div class="col">
    <div class="card">
         <div class="card-header"><h4>Shipping Details</h4> </div> 
         <hr>
         <div class="card-body">
          <table class="table" style="background:#F4F6FA;font-weight: 600;">
            <tr>
                <th>Shipping To:</th>
                <th>{{ $order->firstName }}</th>
            </tr>

            <tr>
                <th>Phone:</th>
                <th>{{ $order->phone }}</th>
            </tr>

            <tr>
                <th>Email:</th>
                <th>{{ $order->email }}</th>
            </tr>

             <tr>
                <th>Shipping Address:</th>
                {{-- <th>{{ $order->address }}</th> --}}
            </tr>

            <tr>
              <th>State:</th>
              <th>{{ $order->state }}</th>
            </tr>

            <tr>
              <th>Zip (Postcode):</th>
              <th>{{ $order->zip }}</th>
            </tr>

             <tr>
              <th>Country:</th>
              <th>{{ $order->country }}</th>
            </tr>

             <tr>
                <th>Order Date   :</th>
                <th>{{ date('F j, Y', strtotime($order->order_date)) }}</th>
            </tr>
            
          </table>
             
         </div>

      </div>
    </div>


    <div class="col">
     <div class="card">
         <div class="card-header"><h4>Order Details
        <span class="text-danger">Invoice : {{ $order->invoice_number }} </span></h4>
          </div> 
         <hr>
         <div class="card-body">
          <table class="table" style="background:#F4F6FA;font-weight: 600;">
            <tr>
                <th> Name :</th>
                <th>{{ $order->user->name }}</th>
            </tr>

            <tr>
                <th>Phone :</th>
              <th>{{ $order->user->phone }}</th>
            </tr>

            <tr>
                <th>Payment Type:</th>
               <th>{{ $order->paymentMethod }}</th>
            </tr>


            <tr>
                <th>Transx ID:</th>
               <th>{{ $order->transaction_id }}</th>
            </tr>

            <tr>
                <th>Order Number:</th>
               <th class="text-danger">{{ $order->order_number }}</th>
            </tr>

            <tr>
                <th>Order Amount:</th>
                 <th>RM{{ $order->amount }}</th>
            </tr>

             <tr>
                <th>Order Status:</th>
                <th>
                  @if ($order->status == 'Pending')
                  <span class="badge rounded-pill bg-warning">Pending</span>
                  @endif
                  @if ($order->status == 'Confirmed')
                    <span class="badge rounded-pill bg-info">Confirmed</span>
                  @endif
                  @if ($order->status == 'Processing')
                    <span class="badge rounded-pill bg-secondary">Processing</span>
                  @endif
                  @if ($order->status == 'Delivered')
                    <span class="badge rounded-pill bg-success">Delivered</span>
                  @endif
                </th>
            </tr>

            <tr>
              <th> </th>
              <th>
              @if($order->status == 'Pending')
              <a href="{{ route('orders.pending.confirm',$order->id) }}" class="btn btn-block btn-success" id="confirm" >Confirmed the Order</a>

              @elseif($order->status == 'Confirmed')
              <a href="{{ route('orders.confirm.processed',$order->id) }}" class="btn btn-block btn-success" id="processing" >Processed the Order</a>

              @elseif($order->status == 'Processing')
              <a href="{{ route('orders.processed.delivered',$order->id) }}" class="btn btn-block btn-success" id="delivered" >Delivered the Order</a>

              @elseif($order->status == 'Delivered')
              <a href="{{ route('orders') }}" class="btn btn-block btn-success" id="delivered" >Succesfully Delivered</a>
              
              @endif

              </th>
            </tr>
            
          </table>
             
         </div>

      </div>
    </div>
  </div>

  <br>

  <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
    <div class="col">
      <div class="card">

        <div class="table-responsive">
              <table class="table" style="font-weight: 600;"  >
                <tbody>
                  <tr>
                      <td class="col-md-1">
                          <label>Image </label>
                      </td>
                      <td class="col-md-2">
                          <label>Product Name </label>
                      </td>
                      <td class="col-md-2">
                          <label>Vendor Name </label>
                      </td>
                      <td class="col-md-2">
                          <label>Product Code  </label>
                      </td>
                      <td class="col-md-1">
                          <label>Color </label>
                      </td>
                      <td class="col-md-1">
                          <label>Size </label>
                      </td>
                      <td class="col-md-1">
                          <label>Quantity </label>
                      </td>

                      <td class="col-md-3">
                          <label>Price  </label>
                      </td> 

                  </tr>


                  @foreach($orderItem as $item)
                  <tr>
                      <td class="col-md-1">
                          <label><img src="{{ asset($item->product->picture) }}" style="width:50px; height:50px;" > </label>
                      </td>
                      <td class="col-md-2">
                          <label>{{ $item->product->products_name }}</label>
                      </td>
                      @if($item->vendor_id == NULL)
                      <td class="col-md-2">
                          <label>Owner </label>
                      </td>
                      @else
                          <td class="col-md-2">
                          <label>{{ $item->product->vendor->name }} </label>
                      </td>
                      @endif
                      
                      <td class="col-md-2">
                          <label>{{ $item->product->code }} </label>
                      </td>
                      @if($item->color == NULL)
                      <td class="col-md-1">
                          <label>.... </label>
                      </td>
                      @else
                      <td class="col-md-1">
                          <label>{{ $item->product->color }} </label>
                      </td>
                      @endif

                      @if ($item->product->size == 1)
                        <td class="col-md-1">
                          <label>S</label>
                        </td>
                      @endif
                      @if ($item->product->size == 2)
                      <td class="col-md-1">
                        <label>M</label>
                      </td>
                      @endif
                      @if ($item->product->size == 3)
                        <td class="col-md-1">
                          <label>L</label>
                        </td>
                      @endif
                      @if ($item->product->size == 4)
                          <td class="col-md-1">
                            <label>XL</label>
                          </td>
                      @endif
                    

                      <td class="col-md-1">
                          <label>{{ $item->quantity }} </label>
                      </td>

                      <td class="col-md-3">
                          <label>RM{{ $item->price }} <br> Total = RM{{ $item->price * $item->quantity }}   </label>
                      </td> 

                  </tr>
                  @endforeach

                </tbody>
              </table>
                          
        </div>

      </div>
    </div>
   
  </div>

  <br>

  {{-- button --}}
  <a href="{{ route('orders') }}"><button type="button" class="btn btn-info">Back</button>

  
</div> 




@endsection
