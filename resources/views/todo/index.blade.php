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
        <h1 class="block uppercase tracking-wide text-gray-700 text-2xl font-bold mb-2 mt-4 text-center">To-Do-List</h1>
        <div class="flex justify-center border-t-2 grid gap-2 grid-cols-2 grid-rows-1">
            <a href='{{ route('todo.create') }}' class="text-center my-5 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Registrar Tarea</a>
            <a href='{{ route('todo.previous') }}' class="text-center my-5 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Tareas Pasadas</a>
        </div>
        <div>
            @if ($tasks->isEmpty())
                <h3 class="block uppercase tracking-wide text-gray-700 text-2xl font-bold mb-2 mt-4">No hay tareas registradas</h3>
            @else
                <div>
                    @if (session('success'))
                        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md mb-4" role="alert">
                            <div class="flex">
                                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                                    </svg></div>
                                <div>
                                    <p class="font-bold">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <form action="{{route('todo.index')}}">
                            <label for="search">Buscar: </label>
                            <input type="text" name="search" id="search">
                            <button type="submit">Buscar</button>
                        </form>

                    </div>
                    <br>
                    
                    <div>
                        <form action="{{ route('todo.index') }}">
                            <label for="categories">Categoria: </label>
                            <select name="categories" id="categories">
                                <option value="1" @selected(request('categories') == 1)>Prioridades</option>
                                <option value="2" @selected(request('categories') == 2)>Fecha</option>
                            </select>

                            <label for="order">De forma: </label>
                            <select name="order" id="order">
                                <option value="1"@selected(request('order') == 1)>Ascendente</option>
                                <option value="2"  @selected(request('order') == 2)>Descendente </option>
                            </select>
                            <button type="submit">Filtrar</button>
                        </form>

                    </div>


                    <div class="mb-2">
                        {{ $tasks->links() }}
                    </div>
                    @foreach ($tasks as $task)
                        <div class="border p-2 rounded shadow-md mb-2">
                            <h4>Tarea: <a href="{{ route('todo.edit', ['id' => $task->id]) }}">{{ $task->name }}</a></h4>
                            <p> Limite: {{ $task->limitDate }}
                                Prioridad:<strong>
                                    @if ($task->priority == 1)
                                        Baja
                                    @elseif ($task->priority == 2)
                                        Media
                                    @elseif ($task->priority == 3)
                                        Alta
                                    @endif
                                </strong>
                            </p><br>

                            <div class="inline-flex">
                                <a href='{{ route('todo.edit', ['id' => $task->id]) }}' class="mr-4 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Editar Tarea</a>

                                <form action="{{ route('todo.destroy', ['id' => $task->id]) }}" method="post" id="frm-delete">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="bg-white hover:bg-gray-100 text-red-900 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Eliminar Tarea</button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
            <br>
        </div>
        <div class="mb-2">
            {{ $tasks->links() }}
        </div>

        <script src="scripts.js"></script>
    </div>
</body>

</html>
