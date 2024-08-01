@extends('admin.layouts.master');

@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-2 p-3 bg-white rounded shadow-sm">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="{{ asset('admin/images/admin.png') }}" />
                                    </div>
                                    <div class="col-7 mt-2">
                                        <h5>Admins</h5>
                                        <h3 class="mt-2">{{ count($admin) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 p-3 mx-2 bg-white rounded shadow-sm">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="{{ asset('admin/images/customer.jpg') }}" />
                                    </div>
                                    <div class="col-7 mt-2">
                                        <h5>Customers</h5>
                                        <h3 class="mt-2">{{ count($customer) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 p-3 bg-white rounded shadow-sm">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="{{ asset('admin/images/category.png') }}" />
                                    </div>
                                    <div class="col-7 mt-2">
                                        <h5>Category</h5>
                                        <h3 class="mt-2">{{ count($categroy) }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 p-3 mx-2 bg-white rounded shadow-sm">
                                <div class="row">
                                    <div class="col-5">
                                        <img src="{{ asset('admin/images/product.png') }}" />
                                    </div>
                                    <div class="col-7 mt-2">
                                        <h5>Products</h5>
                                        <h3 class="mt-2">{{ count($product) }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white my-3">
                            <canvas id="userChart" width="800" class="" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scriptSource')
    <script>
        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Number of Users',
                    data: [],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        $(document).ready(function() {
            $.ajax({
                url: '{{ route('chart') }}',
                type: 'GET',
                success: function(data) {
                    userChart.data.labels = Object.keys(data);
                    userChart.data.datasets[0].data = Object.values(data);
                    userChart.update();
                },
            });
        });
    </script>
@endsection
