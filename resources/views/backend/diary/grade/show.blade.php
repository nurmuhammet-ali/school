@extends('layouts.app')

@section('head_javascript')
<script>
    
</script>
@stop

@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Gündelik</h2>
            </div>
        </div>

        @csrf
        <label for="semester">Çärýek</label>
            <br><br>
            <select name="semester" id="semester" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        
        <diary-day day="monday" semester="{{ request()->semester }}" 
            endpoint="{{ route('diary.grade.update', ['grade' => $grade->id]) }}"></diary-day>
{{-- 
        <timetable-day day="tuesday" semester="{{ request()->semester }}" 
            endpoint="{{ route('timetable.grade.update', ['grade' => $grade->id]) }}"></timetable-day>

        <timetable-day day="wednesday" semester="{{ request()->semester }}" 
            endpoint="{{ route('timetable.grade.update', ['grade' => $grade->id]) }}"></timetable-day>

        <timetable-day day="thursday" semester="{{ request()->semester }}" 
            endpoint="{{ route('timetable.grade.update', ['grade' => $grade->id]) }}"></timetable-day>

        <timetable-day day="friday" semester="{{ request()->semester }}" 
            endpoint="{{ route('timetable.grade.update', ['grade' => $grade->id]) }}"></timetable-day>

        <timetable-day day="saturday" semester="{{ request()->semester }}" 
            endpoint="{{ route('timetable.grade.update', ['grade' => $grade->id]) }}"></timetable-day> --}}
    </div>
@endsection
