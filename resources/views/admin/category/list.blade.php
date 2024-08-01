@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 bg-white p-3 rounded shadow-sm">
                                @if (session('create'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Category Created</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('category#create') }}">
                                    @csrf
                                    <div class="">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="title" />
                                        @error('title')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="my-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="5" cols="30"></textarea>
                                        @error('description')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <button class="btn btn-success" type="submit">Create</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6">
                                <div class="rounded p-3">
                                    <div class="p-3 bg-white">
                                        <form action="{{ route('category#list') }}" method="GET">
                                            <div class="d-flex">
                                                <input type="text" class="form-control" name="search"
                                                    value="{{ request('search') }}" placeholder="Search for category" />
                                                <button class="btn btn-outline-primary"><i
                                                        class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </form>
                                    </div>
                                    @if (count($data) != 0)
                                        <div class="table-responsive table-responsive-data2">
                                            <table class="text-center table table-data2" id="categoryTable">
                                                <thead class="">
                                                    <tr class="fw-bolder">
                                                        <th>NAME</th>
                                                        <th>DESCRIPTION</th>
                                                        <th>DATE</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <span id="" class="row">
                                                        @foreach ($data as $s)
                                                            <tr class="tr-shadow myList" id="categoryList">
                                                                <td class="">{{ $s->title }}</td>
                                                                <td class="desc ">
                                                                    {{ Str::limit($s->description, 50, '...') }}</td>
                                                                <td class="d-none" id="categoryId">{{ $s->id }}</td>
                                                                <td class="desc dateFormat">
                                                                    {{ $s->created_at->format('d-F-Y') }}</td>
                                                                <td>
                                                                    <a href="#" class="text-dark deleteBtn">
                                                                        <i class="fa-solid fa-trash-can fs-5"
                                                                            title="delete"></i>
                                                                    </a>
                                                                    <a href="#" class="text-dark ms-3 editBtn">
                                                                        <i class="fa-solid fa-pen-to-square fs-5"
                                                                            title="edit"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </span>
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <h3 class="text-center text-secondary mt-5">There is no Category</h3>
                                    @endif

                                    <div class="mt-5">
                                        {{ $data->links('pagination::bootstrap-5') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-3" id="detailCategory">

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
            $('.deleteBtn').click(function() {
                $parentNode = $(this).parents('tr')
                $id = $parentNode.find('#categoryId').text()

                $.ajax({
                    type: 'get',
                    data: {
                        id: $id
                    },
                    dataType: 'json',
                    url: "{{ route('category#delete') }}",
                    success: function(response) {
                        $parentNode.hide()
                    }
                })
            })

            $('.editBtn').click(function() {
                $('#categoryTable tr').removeClass('table-primary');
                $(this).parents('tr').addClass('table-primary')
            })

            $('.editBtn').click(function() {
                $parentNode = $(this).parents('tr')
                $id = $parentNode.find('#categoryId').text()

                $.ajax({
                    type: 'get',
                    data: {
                        id: $id
                    },
                    dataType: 'json',
                    url: "{{ route('category#editView') }}",
                    success: function(response) {
                        $list = ""
                        for ($i = 0; $i < response.length; $i++) {
                            $list += `
                            <div class="bg-white rounded border shadow-sm p-3">
                                <form action="{{ route('category#edit') }}" method="POST">
                                    @csrf
                                    <div class="">
                                        <label >Name</label>
                                        <input type="text" value="${response[$i].title}" name="title" class="form-control">
                                    </div>
                                    <input type="hidden" value="${response[$i].id}" name="id">
                                    <div class="my-3">
                                        <label >Description</label>
                                        <textarea class="form-control" name="description" cols="30" rows="4">${response[$i].description}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Update</button>
                                </form>
                            </div>
                            `
                            $('#detailCategory').html($list)
                        }
                    }
                })
            })
        })
    </script>
@endsection
