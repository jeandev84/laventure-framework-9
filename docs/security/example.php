<?php

use App\Providers\UserProvider;
use App\Password\UserPasswordRefresh;
use App\UserTokenStorage;
use Laventure\Component\Security\Auth;
use Laventure\Component\Security\Encoder\Password\PasswordEncoder;
use Laventure\Component\Security\User\Authenticator\UserAuthenticator;
use Laventure\Component\Security\User\Encoder\Password\UserPasswordEncoder;

require_once __DIR__.'/vendor/autoload.php';

/*
$provider        = new UserProvider();
$storage         = new UserTokenStorage();
$passwordEncoder = new PasswordEncoder();
$refreshPassword = new UserPasswordRefresh();
$encoder         = new UserPasswordEncoder($passwordEncoder, $refreshPassword);
$authenticator   = new UserAuthenticator($provider, $storage, $encoder);
# dd($authenticator);
$auth            = new Auth($authenticator);
$authenticated   = $auth->attempt('jeanyao@ymail.com', '123');
#dd($provider->findByUsername('jeanyao@ymail.com'));
dump($authenticated);

$encoder = new PasswordEncoder();
$hash = $encoder->encodePassword('123');
$valid = $encoder->isPasswordValid('123', $hash);
echo $hash, "\n";
echo $valid, "\n";
*/