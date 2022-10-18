@csrf
<input type="text" name="name" placeholder="Nome: " value="{{$user->name ?? old('name')}}">
<input type="email" name="email" id="" placeholder="E-Mail" value="{{$user->email ?? old('email')}}">
<input type="password" name="password" id="" placeholder="Password">
<button type="submit">Enviar</button>
