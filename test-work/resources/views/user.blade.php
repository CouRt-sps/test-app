@extends('layouts.app')

@section('content')
    <a href="/password">Назад</a>
    <div id="app" class="p-5">
        <user-list-component></user-list-component>
    </div>

@endsection
<script>
    window.authUserId = {{ Auth::id() }};
</script>
