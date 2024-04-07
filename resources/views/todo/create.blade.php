<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body class="container mx-10 flex">
    <div class="mx-auto">
        @php
            $task = $task ?? null;
        @endphp

        @if ($task)
            <h1 class="block uppercase tracking-wide text-gray-700 text-2xl font-bold mb-2 mt-4">Editar Tarea</h1>
            @php
                $url_action = route('todo.update', ['id' => request()->id]);
            @endphp
        @else
            <h1 class="block uppercase tracking-wide text-gray-700 text-2xl font-bold mb-2 mt-4">Registro de Tareas</h1>
            @php
                $url_action = route('todo.store');
            @endphp
        @endif
        <form method="POST" action="{{ $url_action }}" class="w-full max-w-lg">
            @if ($task)
                @method('put')
            @else
                @method('post')
            @endif
            @csrf

            <label for="task" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4">Tarea:
            </label>
            <input type="text" name="name" value="{{ $task ? $task->name : '' }}{{ old('name') }}" @class([
                'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 border',
                'border-red-500' => $errors->has('name'),
                'border-gray-200' => !$errors->has('name'),
            ])>
            @error('name')
                <small class="text-red-500">{{ $message }}</small>
            @enderror

            <label for="description" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4">Descripcion: </label>
            <input type="text" name="description" value="{{ $task ? $task->description : '' }}{{ old('description') }}" @class([
                'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 border',
                'border-red-500' => $errors->has('description'),
                'border-gray-200' => !$errors->has('description'),
            ])>
            @error('description')
                <small class="text-red-500">{{ $message }}</small>
            @enderror

            <label for="limitDate" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4">Fecha
                limite:
            </label>
            <input type="date" name="limitDate" min="{{ date('Y-m-d') }}" @class([
                'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 border',
                'border-red-500' => $errors->has('limitDate'),
                'border-gray-200' => !$errors->has('limitDate'),
            ]) value="{{ $task ? $task->limitDate : '' }}{{ old('limitDate') }}">
            @error('limitDate')
                <small class="text-red-500">{{ $message }}</small>
            @enderror

            <label for="priority" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4">Prioridad:
            </label>
            <div class="relative">
                <select name="priority" @class([
                    'appearance-none block w-full bg-gray-200 text-gray-700 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 border',
                    'border-red-500' => $errors->has('priority'),
                    'border-gray-200' => !$errors->has('priority'),
                ])>
                    <option disabled @selected(!$task)>Elige una prioridad</option>
                    <option value="1" @selected(old('priority', $task?->priority) == 1)>Bajo</option>
                    <option value="2" @selected(old('priority', $task?->priority) == 2)>Medio</option>
                    <option value="3" @selected(old('priority', $task?->priority) == 3)>Alto</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
            @error('priority')
                <small class="text-red-500">{{ $message }}</small>
            @enderror

            <input type="submit" value="Guardar" name="save" id="save" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-6">
            <a href="{{ url()->previous() }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-6">Atras</a>
        </form>


    </div>

    <script src="{{ asset('scripts.js') }}"></script>
</body>

</html>
