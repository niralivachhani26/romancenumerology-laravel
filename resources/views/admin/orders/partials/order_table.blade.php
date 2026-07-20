<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Order No</th>
                <th>Product</th>
                <th>Name</th>
                <th>Email</th>
                <th> DOB</th>
                <th>Payment Status</th>
                <th>Interest In</th>
                <th>Sketch</th>
                <th>PDF</th>
                <th>Payment Gateway</th>
            </tr>
        </thead>
        <tbody>
            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->product }}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->bod}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{$order->custom_gender_interest}}</td>
                        <td>{{$order->image_path}}</td>
                        <td>{{$order->pdf_url ?? '--'}}</td>
                        {{-- <td>{{ date('m-d-Y', strtotime($order->created_at)) }}</td> --}}
                       <td> {{$order->payment_gateway}} </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">No orders found.</td>
                </tr>
            @endif
            <div class="d-flex justify-content-center">
                {!! $orders->links() !!} {{-- Render the pagination links --}}
            </div>
        </tbody>
    </table>
</div>


