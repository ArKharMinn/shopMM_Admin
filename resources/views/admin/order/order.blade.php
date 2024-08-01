@extends('admin.layouts.master');

@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Order List</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 offset-8">
                                    <form class="mb-3 form-header" action="{{ route('order#list') }}" method="GET">
                                        @csrf
                                        <input class="au-input" type="text" name="search"
                                            value="{{ request('search') }}" placeholder="Search ...." />
                                        <button class="au-btn--submit" type="submit">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="col-1">
                                    <h3 class="bg-white shadow-lg text-center p-2 rounded"><i
                                            class="fa-solid fa-database"></i> {{ count($order) }} </h3>
                                </div>
                            </div>

                            @if (count($order) != 0)
                                <div class="table-responsive table-responsive-data2">
                                    <table class="text-center table table-data2">
                                        <thead class="">
                                            <tr class="fw-bolder">
                                                <th>ORDER ID</th>
                                                <th>USER NAME</th>
                                                <th>ORDER DATE</th>
                                                <th>ORDER CODE</th>
                                                <th>AMOUNT</th>
                                                <th>STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dataList">
                                            <span id="" class="row">
                                                @foreach ($order as $o)
                                                    <tr class="tr-shadow">
                                                        <input type="hidden" id="statusId" value="{{ $o->id }}">
                                                        <td>
                                                            <span id="orderId"
                                                                class="block-email">{{ $o->id }}</span>
                                                        </td>
                                                        <td class="desc">{{ $o->name }}</td>
                                                        <td class="desc">{{ $o->created_at }}</td>
                                                        <td class="desc">
                                                            <a href="{{ route('order#detail', $o->order_code) }}"
                                                                class="nav-link text-success">
                                                                {{ $o->order_code }}
                                                            </a>
                                                        </td>
                                                        <td class="desc">{{ $o->total }}</td>
                                                        <td class="desc">
                                                            <select name="status" class="statusChange">
                                                                <option value="0"
                                                                    @if ($o->status == 0) selected @endif>
                                                                    Pending</option>
                                                                <option value="1"
                                                                    @if ($o->status == 1) selected @endif>
                                                                    Successed</option>
                                                                <option value="2"
                                                                    @if ($o->status == 2) selected @endif>
                                                                    Rejected</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </span>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE -->
                            @else
                                <h3 class="text-center text-secondary mt-5">There is no Order</h3>
                            @endif

                            <div class="mt-5">
                                {{ $order->links('pagination::bootstrap-5') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.statusChange').change(function() {
                $status = $(this).val();
                $parendNode = $(this).parents('tr');
                $id = $parendNode.find('#statusId').val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('order#status') }}',
                    data: {
                        status: $status,
                        id: $id
                    },
                    dataType: 'json',
                })
            })
        })
    </script>
@endsection
