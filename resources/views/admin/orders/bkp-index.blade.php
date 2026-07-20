@extends('adminlte::page')

@section('title', 'Order')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order List</h3>
                </div>
                <div class="card-body">
                    <table id="navigation-table" class="table table-striped table-bordered table-hover ">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Order No</th>
                          <th>Product</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th> DOB</th>
                          <th>Payment Status</th>
                          <th>Intrest In</th>
                          <th>Sketch</th>
                          <th>PDF</th>
                          <th>Payment Gatway</th>
                        </tr>
                      </thead>
                      <tbody>
                          {{-- @if(count($orders)>0)
                          @foreach($orders as $order)
                        <tr>
                          <thscope="row">{{$loop->iteration}}</thscope=>
                          <td>{{$order->order_no}}</td>
                          <td>{{$order->product}}</td>
                          <td><span class="text-capitalize">{{$order->getTranscript->full_name}}</span></td>
                          <td>{{$order->getTranscript->email}}</td>
                          <td><span class="text-capitalize"> {{$order->status}} </span></td>
                          <td>{{$order->getTranscript->custom_gender_interest}}</td>
                          <td><a href="{{ asset($order->getTranscript->image_path) }}" target="_blank">Soul Sketch</a></td>
                          <td>--</td>
                          <td>{{$order->payment_gateway}}</td>
                        </tr>
                        @endforeach
                        @endif --}}
                      </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
     <script>

            $('#navigation-table').DataTable({
                "pageLength": 10,
                processing: true,
                // serverSide: true,
                ajax: '{{ route("admin.orders.list") }}',
                columns: [
                    {"data": "id"},
                    {"data": "order_no"},
                    {"data": "product"},
                    {"data": "name"},
                    {"data": "email"},
                    {"data": "bod"},
                    {"data": "status"},
                    {"data": "custom_gender_interest"},
                    {"data": "image_path"},

                    {"data" : "pdf_url"},
                    // {"data" : "created_at"},
                    {"data" : "payment_gateway"},
                    // {"data": "status"},
                    // {"data": "browser"},
                    // {
                    //     "mRender": function(data, type, row) {
                    //         // var html = '';
                    //         if(row.status == 1){
                    //             return '<span class="badge bg-success">Active</span>';
                    //         }else if(row.status == 2){
                    //             return '<span class="badge bg-warning">In-active</span>';
                    //         }else{
                    //             return '<span class="badge bg-danger">Deleted</span>';
                    //         }
                    //     },
                    //     orderable: true
                    // },
                    // {"data": "host_info"},
                    // {
                    //     "mRender": function(data, type, row) {
                    //         return '<a href="{{ URL::to('admin/manage/admin') }}/' + row.id + '" class="btn btn-sm btn-primary">\
                    //                 <i class="fa fa-eye fa-fw"></i>\
                    //             </a>';
                    //     },
                    //     orderable: false
                    // }
                    // {
                    //     "mRender": function(data, type, row) {
                    //         return '<a href="{{ URL::to('admin/award/update') }}/' + row.id + '">\
                    //                 <i class="fa fa-edit fa-fw"></i>\
                    //             </a>\
                    //             <a class="delete_admins" href="{{ URL::to('admin/award/delete') }}/' + row.id + '">\
                    //                 <i class="fa fa-trash fa-fw"></i>\
                    //             </a>';
                    //     },
                    //     orderable: false
                    // }
                ],
                order: [
                    [0, 'desc']
                ],
                // paging: true,
                // autoFill: true,

                // "lengthChange": false,
                // "searching": false,
                // "ordering": true,
                // "info": true,
                // autoWidth: false,
                // responsive: true,
            });

    </script>
@stop
