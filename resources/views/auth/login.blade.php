@extends('layouts.frontend')

@section('content')

<div class="w-full max-w-xs mx-auto">
    <form method="POST" action="{{ route('login') }}" class="bg-white shadow rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                Ulanyjy ady
            </label>
            <input class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" id="username">
            @error('username')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Açar sözi
            </label>
            <input class="shadow appearance-none border @error('password') border-red-500 @enderror rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" id="password" placeholder="******************">
            @error('password')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-500 font-bold">
                <input class="mr-2 leading-tight" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="text-sm">
                    Meni ýatda sakla
                </span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Gir
            </button>
        </div>
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <p class="text-red">{{ $error }}</p>
            @endforeach
        @endif
    </form>
</div>

@endsection
