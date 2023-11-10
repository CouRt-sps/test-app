@extends('layouts.app')

@section('content')
    @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="/user">Пользователи</a>
    @endif
    <div id="app" class="p-5">
        <password-list-components></password-list-components>
    </div>

@endsection
<script>
    window.authUserId = {{ Auth::id() }}
</script>
