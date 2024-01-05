@extends('layouts.sidebar')

@section('content')
<div class="shadow rounded-3 p-3 mt-4" style="background-color: var(--bs-body-bg);">
    <div id="chat-container" class="overflow-auto" style="height: 75vh !important;">
        @foreach ($chat as $chatting)
        {{-- saya sendiri --}}
            @if ($chatting->user->id === auth()->user()->id)
                <div class="d-flex justify-content-end align-items-start mb-2">
                    <div class="p-3 rounded text-white {{strlen($chatting->chat) > 80 ? 'desktop-w-50' : ''}}" style="background-color: var(--bs-success);">
                        <p class="mb-0 text-xs text-end" style="color: rgba(225, 225, 225);"><span class="{{$chatting->user->jabatan === 'Admin' ? 'text-primary' : ''}}">{{$chatting->user->jabatan}}</span> {{$chatting->created_at}}</p>
                        <h6 class="mb-0 text-end">{{$chatting->user->name}}</h6>
                        <p class="mb-0 {{strlen($chatting->chat) < 80 ? 'text-end' : ''}}" style="color: rgba(225, 225, 225);">{{$chatting->chat}}</p>
                    </div>
                    <div class="pt-3">
                        <i class="fa fa-fw fa-xl fa-user-circle ms-2"></i>
                    </div>
                </div>
            @else
            {{-- orang lain --}}
                <div class="d-flex align-items-start mb-2">
                    <div class="pt-3">
                        <i class="fa fa-fw fa-xl fa-user-circle me-2"></i>
                    </div>
                    <div class="p-3 rounded {{strlen($chatting->chat) > 80 ? 'desktop-w-50' : ''}}" style="background-color: var(--bs-secondary-bg)">
                        <p class="mb-0 text-xs" style="color: var(--bs-body-color);">{{$chatting->created_at}} <span class="{{$chatting->user->jabatan === 'Admin' ? 'text-primary' : ''}} {{$chatting->user->jabatan === 'Karyawan' ? 'text-success' : ''}}">{{$chatting->user->jabatan}}</span></p>
                        <h6 class="mb-0">{{$chatting->user->name}}</h6>
                        <p class="mb-0 style="color: var(--bs-body-color);">{{$chatting->chat}}</p>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div>
        <form action="/chat" class="d-flex align-items-center mt-3" method="post">
            @csrf
            <input type="text" name="chat" class="form-control rounded-start rounded-end-0" placeholder="Ketik pesan. . .">
            <button type="submit" class="btn btn-primary rounded-start-0 rounded-end"><i class="fa fa-fw fa-paper-plane"></i></button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
</script>
@endsection