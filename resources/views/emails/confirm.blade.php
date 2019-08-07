Hola {{ $user->name }}

Has cambiado tu correo electronico. Por favor verificalo <a href="{{ route('verify', $user->verified_token) }}">aquí.</a>
