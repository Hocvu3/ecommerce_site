<div class="tab-pane fade " id="v-pills-messages2" role="tabpanel"
aria-labelledby="v-pills-messages-tab2">
<div class="fp_dashboard_body">
    <h3>Wishlist</h3>
    <div class="fp_dashboard_order">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr class="t_header">
                        <th class="sl_no">SL</th>
                        <th class="package">Product Name</th>
                        <th class="price">Stock</th>
                        <th class="qnty">Created Date</th>
                        <th class="qnty">Action</th>
                    </tr>
                    @foreach ($wishLists as $item)
                    <tr>
                        <td class="sl_no">{{ ++$loop->index }}</td>
                        <td class="package">
                            <p>{{ $item->product->name }}</p>
                        </td>
                        <td class="price">
                            @if ($item->product->quantity>0)
                                <h5 class="text-success">In Stock</h5>
                            @else
                            <h5 class="text-danger">Sold Out</h5>
                            @endif
                        </td>
                        <td class="qnty">
                            <p>{{ $item->created_at }}</p>
                        </td>
                        <td class="qnty">
                            <a href="{{ route('product.show',$item->product->slug) }}" class="btn btn-primary">View Detail</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
