@extends('admin.layouts.master');

@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="">
                            <div class="col-8 offset-2 rounded bg-white p-3">
                                <h4 class="">Admins</h4>
                                <div class="p-2 my-2">
                                    <form action="" method="GET">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ request('search') }}" placeholder="Search for admin" />
                                    </form>
                                </div>
                                @if (count($admin) != 0)
                                    <div class="table-responsive table-responsive-data2">
                                        <table class="text-center table table-data2 " id="">
                                            <thead class="">
                                                <tr class="fw-bolder">
                                                    <th>PROFILE</th>
                                                    <th>NAME</th>
                                                    <th>EMAIL</th>
                                                    <th>GENDER</th>
                                                    <th>DATE</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <span id="" class="row">
                                                    @foreach ($admin as $s)
                                                        <tr class="tr-shadow myList" id="cusList">
                                                            <td class="col-1">
                                                                <img class="rounded-circle"
                                                                    src="{{ asset('admin/images/profileMale.jpg') }}">
                                                            </td>
                                                            <td class="">{{ $s->name }}</td>
                                                            <td class="desc ">{{ $s->email }}</td>
                                                            <td class="desc">{{ $s->gender }}</td>
                                                            <td class="d-none" id="cusId">{{ $s->id }}</td>
                                                            <td class="desc dateFormat">
                                                                {{ $s->created_at->format('d-F-Y') }}</td>
                                                            <td>
                                                                @if (Auth::user()->id != $s->id)
                                                                    <a href="#"
                                                                        class="text-danger deleteBtn bg-dark rounded-circle p-2">
                                                                        <i class="fa-solid fa-trash-can" title="delete"></i>
                                                                    </a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </span>
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <h3 class="text-center text-secondary mt-5">There is no Admin</h3>
                                @endif

                                <div class="mt-5">
                                    {{ $admin->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $('.myList').hover(
                function() {
                    $(this).addClass('table-danger');
                },
                function() {
                    $(this).removeClass('table-danger');
                }
            )
            $('.deleteBtn').click(function() {
                $parentNode = $(this).parents('tr')
                $id = $parentNode.find('#cusId').text()

                $.ajax({
                    type: 'get',
                    data: {
                        id: $id
                    },
                    dataType: 'json',
                    url: "{{ route('admin#delete') }}",
                    success: function(response) {
                        $parentNode.hide()
                    }
                })
            })
        })
    </script>
@endsection
