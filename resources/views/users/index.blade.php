<x-app title="Usuarios">
    <section class="container">
        <div class="d-flex justify-content-center my-4">
            <h1>Lista de Usuarios</h1>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-end">
                <a href="{{route('users.create')}}" class="btn btn-primary">Crear ususario</a>
            </div>
            <div class="card-body">
                <div class="table-responsive my-4 mx-2">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Cedula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->number_id}}</th>
                                    <td scope="row">{{$user->name}}</td>
                                    <td scope="row">{{$user->last_name}}</td>
                                    <td scope="row">{{$user->email}}</td>
                                    <td scope="row">
                                        @foreach ($user->roles as $role)
                                        {{$role->name}},
                                        @endforeach
                                    </td>
                                    <td scope="row">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{route('users.edit', ['user'=>$user->id])}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pencil"></i></a>
                                            <form action="{{route('users.destroy', ['user'=>$user->id])}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </section>
</x-app>
