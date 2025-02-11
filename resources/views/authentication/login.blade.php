@if ($message = Session::get('error'))
    {{ $message }}
@endif

@if ($error = Session::get('error'))
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif


<form action="{{ route('login.auth') }}" method="POST">

    @csrf
    <input type="text" name="username" placeholder="Usuário">
    <input type="password" name="password" placeholder="Senha">
    <button type="submit">Login</button>
</form>
