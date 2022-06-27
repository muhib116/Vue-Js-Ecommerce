<table>
    <thead>
        <tr style="background: red;">
            <th>Serial</th>
            <th>Invoice Id</th>
            <th>Date</th>
            <th>Customer</th>
            <th>Mobile</th>
            <th>Qty</th>
            <th>Rate</th>
            <th>Amount</th>
            <th>Shipping Address</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($voucherTimelines as $index => $voucherTimeline)
        <tr>
            <td>{{$index+1}}</td>
            <td>{{$voucherTimeline->invoice_id}} </td>
            <td>{{\Carbon\Carbon::parse($voucherTimeline->invoice_date)->format(Config::get('siteSetting.date_format'))}} </td>
           	<td>{{ $voucherTimeline->shipping_name }}</td>
            <td>{{ str_replace('+88','', $voucherTimeline->shipping_phone) }}</td>
            <td>{{$voucherTimeline->voucher_qty}}</td>
            <td>{{$voucherTimeline->voucher_rate}}</td>
            <td>{{$voucherTimeline->voucher_qty * $voucherTimeline->voucher_rate}}</td>
            <td>
                {{ $voucherTimeline->shipping_address }},
                {{ $voucherTimeline->shipping_area }},
                {{ $voucherTimeline->shipping_city }},
                {{ $voucherTimeline->shipping_region }}
            </td>
            <td>{{$voucherTimeline->status}}</td>
        </tr>
        @endforeach
    </tbody>
</table>