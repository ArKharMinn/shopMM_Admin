@extends('admin.layouts.master');

@section('title', 'Voucher');

@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <a href="{{ route('order#list') }}" class="p-2 btn btn-dark">
                        <i class="fa-solid fa-arrow-left"></i> Back
                    </a>
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="my-3 bg-white col-md-5 rounded shadow-sm p-4">
                                <h3><i class="fa-solid fa-ticket-simple me-2"></i>Order Voucher</h3>
                                <div class="row mt-5">
                                    <div class="col-6">
                                        <h5><i class="me-2 fa-solid fa-user"></i>NAME</h5>
                                        <h5 class="my-3"><i class="me-2 fa-solid fa-barcode"></i>ORDER CODE</h5>
                                        <h5><i class="me-2 fa-regular fa-clock"></i>ORDER TIME</h5>
                                        <h5 class="mt-3"><i class="me-2 fa-solid fa-money-bill"></i>TOTAL</h5>
                                    </div>

                                    <div class="col-6">
                                        <h5>{{ $detail->name }}</h5>
                                        <h5 class="my-3">{{ $detail->order_code }}</h5>
                                        <h5>{{ $detail->created_at->format('j-F-Y') }}</h5>
                                        <h5 class="mt-3">{{ $detail->total }}</h5>
                                    </div>
                                </div>
                            </div>

                            {{-- @if (count($data) != 0) --}}
                            <div class="table-responsive table-responsive-data2">
                                <table class="text-center table table-data2">
                                    <thead class="">
                                        <tr class="fw-bolder">
                                            <th>PRODUCT IMAGE</th>
                                            <th>ORDER ID</th>
                                            <th>PRODUCT NAME</th>
                                            <th>ORDER DATE</th>
                                            <th>QTY</th>
                                            <th>AMOUNT</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <span id="" class="row">
                                            @foreach ($order as $order)
                                                <tr class="tr-shadow">
                                                    <td class="col-1">
                                                        <img src="{{ asset('storage/' . $order->image) }}" class="">
                                                    </td>
                                                    <td class="desc">{{ $order->id }}</td>
                                                    <td class="desc">{{ $order->title }}</td>
                                                    <td class="desc">{{ $order->created_at->format('j-F-Y') }}</td>
                                                    <td class="desc">{{ $order->qty }}</td>
                                                    <td class="desc">{{ $order->total + 3000 }}</td>
                                                </tr>
                                            @endforeach
                                        </span>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
