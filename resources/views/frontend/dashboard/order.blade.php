<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="fp_dashboard_body">
        <h3>order list</h3>
        <div class="fp_dashboard_order">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr class="t_header">
                            <th>Order</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <h5>#{{ $order->invoice_id }}</h5>
                                </td>
                                <td>
                                    <p>{{ date('F d, Y', strtotime($order->created_at)) }}</p>
                                </td>
                                <td>
                                    @if ($order->order_status === 'pending')
                                        <span class="active">Pending</span>
                                    @elseif ($order->order_status === 'in_process')
                                        <span class="active">In Process</span>
                                    @elseif ($order->order_status === 'delivered')
                                        <span class="complete">Delivered</span>
                                    @else
                                        <span class="cancel">Cancelled</span>
                                    @endif
                                </td>
                                <td>
                                    <h5>${{ $order->grand_total }}</h5>
                                </td>
                                <td><a class="view_invoice" onclick="viewInvoice('{{ $order->id }}')">View
                                        Details</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @foreach ($orders as $order)
            <div class="fp__invoice invoice_detail_{{ $order->id }}">
                <a class="go_back"><i class="fas fa-long-arrow-alt-left"></i> go back</a>
                <div class="fp__track_order">
                    <ul>
                        <li
                            class="{{ in_array($order->order_status, ['pending', 'in_process', 'delivered']) ? 'active' : '' }}">
                            order pending</li>
                        <li class="{{ in_array($order->order_status, ['in_process', 'delivered']) ? 'active' : '' }}">order
                            in process</li>
                        <li class="{{ in_array($order->order_status, ['delivered']) ? 'active' : '' }}">order delivered
                        </li>
                    </ul>
                </div>
                <div class="fp__invoice_header">
                    <div class="header_address">
                        <h4>invoice to</h4>
                        <p>{{ @$order->address }}</p>
                        <p> {{ @$order->user_address->phone }}</p>
                    </div>
                    <div class="header_address">
                        <p><b>invoice no: </b><span> #{{ $order->invoice_id }}</span></p>
                        <p><b>Order ID:</b> <span> #{{ $order->invoice_id }}</span></p>
                        <p><b>date:</b> <span> {{ date('d-m-Y', strtotime($order->created_at)) }}</span></p>
                    </div>
                </div>
                <div class="fp__invoice_body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr class="border_none">
                                    <th class="sl_no">SL</th>
                                    <th class="package">item description</th>
                                    <th class="price">Price</th>
                                    <th class="qnty">Quantity</th>
                                    <th class="total">Total</th>
                                </tr>
                                @foreach ($order->order_item as $item)
                                    @php
                                        $size = json_decode($item->product_size);
                                        $options = json_decode($item->product_option);

                                        $qty = $item->qty;
                                        $unit_price = $item->unit_price;
                                        $size_price = $size->price ?? 0;
                                        $option_price = 0;
                                        foreach ($options as $optionItem) {
                                            $option_price += $optionItem->price;
                                        }
                                        $total = ($option_price + $size_price + $unit_price) * $qty;
                                        //dd($total,$option_price,$size_price,$qty)
                                    @endphp
                                    <tr>
                                        <td class="sl_no">{{ ++$loop->index }}</td>
                                        <td class="package">
                                            <p>{{ $item->product_name }}</p>
                                            <span class="size">{{ @$size->name }} -
                                                {{ @$size->price ? '$' . @$size->price : '' }}</span>
                                            @foreach ($options as $option)
                                                <span
                                                    class="coca_cola">{{ @$option->name }}-{{ @$option->price ? '$' . @$option->price : '' }}</span>
                                            @endforeach
                                        </td>
                                        <td class="price">
                                            <b>${{ @$item->unit_price }}</b>
                                        </td>
                                        <td class="qnty">
                                            <b>{{ $item->qty }}</b>
                                        </td>
                                        <td class="total">
                                            <b>${{ $total }}</b>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="package" colspan="3">
                                        <b>sub total</b>
                                    </td>
                                    <td class="qnty">
                                        <b>{{ $order->product_qty }}</b>
                                    </td>
                                    <td class="total">
                                        <b>${{ $order->subtotal }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="package coupon" colspan="3">
                                        <b>(-) Discount coupon</b>
                                    </td>
                                    <td class="qnty">
                                        <b></b>
                                    </td>
                                    <td class="total coupon">
                                        <b>${{ $order->discount }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="package coast" colspan="3">
                                        <b>(+) Shipping Cost</b>
                                    </td>
                                    <td class="qnty">
                                        <b></b>
                                    </td>
                                    <td class="total coast">
                                        <b>${{ $order->delivery_charge }}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="package" colspan="3">
                                        <b>Total Paid</b>
                                    </td>
                                    <td class="qnty">
                                        <b></b>
                                    </td>
                                    <td class="total">
                                        <b>${{ $order->grand_total }}</b>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <a class="print_btn common_btn d-print-none" id="print_pdf" onclick="printPdf('{{ $order->id }}')"
                    href="#"><i class="far fa-print"></i>
                    print
                    PDF</a>

            </div>
        @endforeach
    </div>
</div>
@push('scripts')
    <script>
        function viewInvoice(id) {
            $(".fp_dashboard_order").fadeOut();
            $(".invoice_detail_" + id).fadeIn();
        };

        function printPdf(id) {
            let printContents = $('.invoice_detail_'+id).html();

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
        };
        $(document).ready(function() {

        })
    </script>
@endpush
