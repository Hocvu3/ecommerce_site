@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Invoice</h1>
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">ID: #{{ $orders->invoice_id }}</div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Billed To:</strong><br>
                                        Address: {{ $orders->address }}<br>
                                        Name: {{ $orders->user_address->first_name}}, {{ $orders->user_address->last_name}}<br>
                                        Email: {{ $orders->user_address->email }}<br>
                                        Phone: {{ $orders->user_address->phone }}<br>
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Payment Method:</strong><br>
                                        {{ $orders->payment_method }}<br>
                                        <br>
                                        @if ($orders->payment_status === 'pending')
                                            <span class="badge badge-primary">Pending</span>
                                        @elseif ($orders->payment_status === 'completed')
                                            <span class="badge badge-success">Completed</span></span>
                                        @else
                                            <span class="badge badge-warning">{{ $orders->payment_status }}</span></span>
                                        @endif
                                    </address>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        {{ date('d-m-Y',strtotime($orders->created_at)) }}<br><br>
                                        @if ($orders->order_status === 'pending')
                                            <span class="badge badge-primary">Pending</span>
                                        @elseif ($orders->order_status === 'delivered')
                                            <span class="badge badge-success">Delivered</span></span>
                                        @elseif ($orders->order_status === 'declined')
                                            <span class="badge badge-warning">Declined  </span></span>
                                        @elseif ($orders->order_status === 'cancel')
                                            <span class="badge badge-danger">Cancelled</span></span>
                                        @endif
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <p class="section-lead">All items here cannot be deleted.</p>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th data-width="40">#</th>
                                        <th>Item</th>
                                        <th>Size & Options</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-right">Totals</th>
                                    </tr>
                                    @foreach ($orders->order_item as $item)
                                    @php
                                        $size = json_decode($item->product_size);
                                        $option = json_decode($item->product_option);

                                        $qty = $item->qty;
                                        $unit_price = $item->unit_price;
                                        $size_price = $size->price ?? 0;
                                        $option_price = 0;
                                        foreach ($option as $optionItem){
                                            $option_price += $optionItem->price;
                                        }
                                        $total = ($option_price + $size_price + $unit_price) * $qty;
                                        // dd($total,$qty)
                                    @endphp
                                    <tr>
                                        <td>{{ ++$loop->index }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>
                                        <li class="size">
                                                {{ @$size->name }} - {{@$size->price ? '$'.@$size->price : ''}}
                                        </li>
                                            @foreach ($option as $optionItem)
                                            <li>
                                                {{ @$optionItem->name }} - {{@$optionItem->price ? '$'.@$optionItem->price : ''}}
                                            </li>
                                            @endforeach
                                        </td>
                                        <td class="text-center">${{ $item->unit_price }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-right">${{ $total }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-8 d-print-none">
                                    <form action="{{ route('admin.order.update',$orders->id) }}">
                                        <div class="form-group">
                                            <div class="mb-2">
                                                <label>Payment Status</label>
                                                <select class="form-control" name="payment_status" id="">
                                                    <option {{ $orders->payment_status === 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                                    <option {{ $orders->payment_status === 'completed' ? 'selected' : '' }} value="completed">Completed</option>
                                                </select>
                                            </div>
                                            <div>
                                                <label>Order Status</label>
                                                <select class="form-control" name="order_status" id="">
                                                    <option {{ $orders->order_status === 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                                                    <option {{ $orders->order_status === 'in_process' ? 'selected' : '' }} value="in_process">In Process</option>
                                                    <option {{ $orders->order_status === 'delivered' ? 'selected' : '' }} value="delivered">Delivered</option>
                                                    <option {{ $orders->order_status === 'declined' ? 'selected' : '' }} value="declined">Declined</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Update!</button>
                                    </form>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Subtotal</div>
                                        <div class="invoice-detail-value">${{ $orders->subtotal }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Shipping</div>
                                        <div class="invoice-detail-value">${{ $orders->delivery_charge }}</div>
                                    </div>
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Discount</div>
                                        <div class="invoice-detail-value">${{ $orders->discount }}</div>
                                    </div>
                                    <hr class="mt-2 mb-2">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">${{ $orders->grand_total }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-md-right">
                    <button class="btn btn-warning btn-icon icon-left" id="btn_print"><i class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
$(document).ready(function(){
    $('#btn_print').on('click', function() {
        // Get the HTML content to be printed
        let printContents = $('.invoice-print').html();

        // Open a new window for printing
        let printWindow = window.open('', '', 'width=800,height=800');

        // Write the HTML content into the new window
        printWindow.document.open();
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
                <body>
                    ${printContents}
                </body>
            </html>
        `);
        printWindow.document.close();

        // Ensure the content is fully loaded before printing
        setTimeout(function() {
            printWindow.print();
            printWindow.close();
        }, 500);
    });
})
</script>
@endpush
