@if ($message = Session::get('error'))
    {{ $message }}
@endif

@if ($error = Session::get('error'))
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif


<form action="{{ route('create-account') }}" method="POST">

    @csrf
    <input type="number" name="id" value="{{ $id }}" placeholder="{{ $id }}" readonly hidden>
    <input type="text" name="username" placeholder="Usuário">
    <input type="text" name="name" placeholder="Nome">

    <input type="password" name="password" placeholder="Senha">
    <input type="password" name="confirm_password" placeholder="Senha">
    <button type="submit">Cadastrar</button>
</form>
