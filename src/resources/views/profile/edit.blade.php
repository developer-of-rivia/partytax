@extends('profile.layouts.profile-layout')


@section('specific_content')

    <div class="container">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Выйти</button>
        </form>
        <!---->
        <!---->
        <!---->
        <h4 class="mt-5">Информация о пользователе</h4>
        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')
    
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
    
            <div class="mt-3">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
    
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800">
                            {{ __('Your email address is unverified.') }}
    
                            <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
    
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
            <div class="mt-3">
                <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
    
                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
        <!---->
        <!---->
        <!---->
        <h4 class="mt-5">Изменение пароля</h4>
        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')
    
            <div class="mt-2">
                <x-input-label for="update_password_current_password" :value="__('Текущий пароль')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="update_password_password" :value="__('Новый пароль')" />
                <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>
            <div class="mt-2">
                <x-input-label for="update_password_password_confirmation" :value="__('Повторите пароль')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="mt-3">
                <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
    
                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
        <!---->
        <!---->
        <!---->
        <h4 class="mt-5">Удаление аккаунта</h4>
        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить аккаунт</button>
        </form>
    </div>
@endsection