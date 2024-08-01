@extends('admin.layouts.master');

@section('content')
    <div class="page-wrapper">
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">

                    <div class="container-fluid">
                        <div class="row bg-white col-10 offset-1">
                            <div class="col-3">
                                <div class="py-4">
                                    <h4 class="">Chats</h4>
                                    <div class="p-2 my-2">
                                        <form action="" method="GET">
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}" placeholder="Search..." />
                                        </form>
                                    </div>
                                </div>
                                @if (count($cus) != 0)
                                    <div class="p-3">
                                        @foreach ($cus as $s)
                                            <a href="{{ route('chat#list', ['id' => $s->id]) }}" class="nav-link">
                                                <div
                                                    class="p-2 d-flex justify-start align-items-center @if (request('id') == $s->id) rounded bg-primary @endif">
                                                    @if ($s->image)
                                                        <img src="{{ asset('storage/' . $s->image) }}" style="width: 50px"
                                                            class="rounded-circle" />
                                                    @else
                                                        <img src="{{ asset('admin/images/profileMale.jpg') }}"
                                                            style="width: 50px" class="rounded-circle" />
                                                    @endif
                                                    <h5 class="mx-3 @if (request('id') == $s->id) text-white @endif">
                                                        {{ $s->name }}</h5>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @else
                                    <h3 class="text-centers my-5">There is no Customer</h3>
                                @endif
                            </div>
                            <div class="col-6 p-3">
                                @if (request('id') != 0)

                                    <div class="col-10 offset-1" style="height: calc(500px);overflow-y: auto;">
                                        @if (count($message) != 0)
                                            <div class="mt-3">
                                                @if (Auth::user()->role == 'admin')
                                                    @foreach ($message as $message)
                                                        @if ($message->to_userId == Auth::user()->id)
                                                            <div
                                                                class="d-flex my-2 justify-content-start align-items-center">
                                                                <p class="bg-secondary p-3 rounded text-white">
                                                                    {{ $message->message }}</p>
                                                            </div>
                                                        @else
                                                            <div class="d-flex my-2 justify-content-end align-items-center">

                                                                <p class="bg-primary p-3 rounded text-white">
                                                                    {{ $message->message }}</p>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @else
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    <div class="">
                                        <form action="{{ route('chat#send') }}" method="POST">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="hidden" value="{{ request('id') }}" name="cusId" />
                                                <textarea rows="4" name="message" class="form-control @error('message') is-invalid @enderror me-3"
                                                    placeholder="Enter Message"></textarea>
                                                <div class="">
                                                    <button type="submit" title="send"
                                                        class="btn p-3 btn-success rounded-circle">
                                                        <i class="fa-solid fa-paper-plane"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            <div class="col-3 p-3">
                                <div class=" text-center mt-4">
                                    @if (request('id'))
                                        <div class="">
                                            @if ($cusDetail->image)
                                                <img src="{{ asset('storage/' . $cusDetail->image) }}" style="width: 100px"
                                                    class="rounded-circle" />
                                            @else
                                                <img src="{{ asset('admin/images/profileMale.jpg') }}" style="width: 100px"
                                                    class="rounded-circle" />
                                            @endif
                                            <h4 class="my-2">{{ $cusDetail->name }}</h4>
                                            <p class="">{{ $cusDetail->email }}</p>
                                            <div class="text-start p-3 border shadow-sm mt-5">
                                                <p class="">Address : {{ $cusDetail->address }}</p>
                                                <p class="">Gender : {{ $cusDetail->gender }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
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

        })
    </script>
@endsection
