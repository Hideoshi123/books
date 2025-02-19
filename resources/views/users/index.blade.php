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
                    <table class="table table-bordered" id="user_table">
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
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>

                                            <button class="ms-2 btn btn-danger btn-sm"
                                                onclick="deleteForm({{ $user->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <form id="delete_form_{{ $user->id }}"
                                                action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
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
    <x-slot:scripts>
        <script>
            document.addEventListener('DOMContentLoaded', loadDatatable);

            function loadDatatable() {
                $('#user_table').DataTable()
            };
            async function deleteForm(user_id) {
                const response = await Swal.fire({
                    icon: 'warning',
                    title: 'Esta seguro de eliminar?',
                    showCancelButton: true
                })
                if (!response.isConfirmed) return
                document.getElementById(`delete_form_${user_id}`).submit();
            };
        </script>
    </x-slot:scripts>
</x-app>
