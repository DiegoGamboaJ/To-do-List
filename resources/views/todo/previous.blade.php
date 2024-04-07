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
        <h1 class="block uppercase tracking-wide text-gray-700 text-2xl font-bold mb-2 mt-4 text-center">Tareas pasadas</h1>
        <div>

            @foreach ($tasks as $task)
                <div class="border p-2 rounded shadow-md mb-2">
                    <h4 class="text-red-900">Tarea: {{ $task->name }}</h4>
                    <p class="text-red-900"> Limite: {{ $task->limitDate }}
                        Prioridad:<strong class="text-red-900">
                            @if ($task->priority == 1)
                                Baja
                            @elseif ($task->priority == 2)
                                Media
                            @elseif ($task->priority == 3)
                                Alta
                            @endif
                        </strong>
                    </p><br>
                </div>
            @endforeach

            <br>
        </div>
        <div class="flex justify-center border-t-2 ">
            <a href="{{ url()->previous() }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center mt-6">Atras</a>
        </div>
        <script src="scripts.js"></script>
    </div>
</body>

</html>
