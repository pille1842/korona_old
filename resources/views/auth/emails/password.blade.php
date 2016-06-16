{{ trans('auth.click_here_for_reset') }}: <a href="{{ $link = url('password/reset', $token).'?username='.urlencode($user->getUsername()) }}"> {{ $link }} </a>
