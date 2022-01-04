@extends('layouts.app')

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Klas : {{ $grade->class_name }}</h2>
            </div>
        </div>
        @csrf

        <journal grade="{{ $grade->id }}" subjects-endpoint="{{ route('get.subjects') }}" students="{{ $students }}" />

    </div>
@endsection
