<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Invoice</title>

    <style>
        body{margin-top:20px;
background-color: #f7f7ff;
}
#invoice {
    padding: 0px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #0d6efd
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #0d6efd
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #0d6efd;
    background: #e7f2ff;
    padding: 10px;
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,
.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #0d6efd;
    font-size: 1.2em
}

.invoice table .qty,
.invoice table .total,
.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #0d6efd
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #0d6efd;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0);
    border-radius: .25rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 6px 0 rgb(218 218 253 / 65%), 0 2px 6px 0 rgb(206 206 238 / 54%);
}

.invoice table tfoot tr:last-child td {
    color: #0d6efd;
    font-size: 1.4em;
    border-top: 1px solid #0d6efd
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px !important;
        overflow: hidden !important
    }
    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }
    .invoice>div:last-child {
        page-break-before: always
    }
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #0d6efd;
    background: #e7f2ff;
    padding: 10px;
}
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id="invoice">
                    <div class="invoice overflow-auto">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                   
                                    <div class="col company-details">
                                        <h2 class="name">
                                            <a target="_blank" href="#">
                                        Zac Fashion
                                        </a>
                                        </h2>
                                        <div>455 Foggy Heights, Rawang 85004, Selangor</div>
                                        <div>(+60) 107-640 797</div>
                                        <div>zac-fashion@example.com</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to">{{ $order->firstName }}</h2>
                                        <div class="address">{{ $order->address }}</div>
                                        <div class="email"><a href="mailto:john@example.com">{{ $order->email }}</a>
                                        </div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE {{ $order->invoice_number }}</h1>
                                        <div class="date">Date of Invoice: {{ date('F j, Y', strtotime($order->order_date)) }}</div>
                                        {{-- <div class="date">Due Date: 30/10/2018</div> --}}
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th class="text-left">DESCRIPTION</th>
                                            <th class="text-right">PRODUCT DETAILS</th>
                                            <th class="text-right">QUANTITY</th>
                                            <th class="text-right">PRICE (RM)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem as $item)

                                        <tr>
                                            <td class="no">{{ $loop->iteration }}</td>
                                            <td class="text-left">
                                                <h3>
                                                    <img src="{{ ($item->product->picture) }}" height="50px;" width="50px;" alt="">
                                                    <span>{{$item->product->products_name}}</span>
                                                    {{-- <a target="_blank" href="javascript:;">{{$item->product->products_name}}</a> --}}
                                                </h3>
                                            </td>
                                            <td class="description">
                                                {{$item->product->description}}
                                                {{$item->product->color}}
                                            </td>
                                            <td class="qty">1</td>
                                            <td class="price">RM {{$item->product->price}}</td>
                                        </tr>
                                            
                                        @endforeach
                                       
                                        
                                    </tbody>
                                    <tfoot>
                                        {{-- <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td>$5,200.00</td>
                                        </tr> --}}
                                        {{-- <tr>
                                        
                                            <td colspan="2"></td>
                                            <td colspan="2">TAX 25%</td>
                                            <td>$1,300.00</td>
                                        </tr> --}}
                                        <tr>

                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">GRAND TOTAL</td>
                                            <td>RM {{$cartTotal}}</td>
                                        </tr>

                                    </tfoot>
                                </table>
                                <div class="notices mt-5">
                                    <div class="thanks ">Thank you!</div>
                                    <div>NOTICE:</div>
                                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                                </div>

                            </main>
                            <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>