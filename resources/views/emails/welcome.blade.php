Hola {{ $user->name }}

gracias por crear una cuenta. Por favor verificalo <a href="{{ route('verify', $user->verified_token) }}">aquí.</a>
