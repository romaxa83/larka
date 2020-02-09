<table class="table table-head-fixed">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Roles</th>
        <th>Created</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>{{$user->getRolesString()}}</td>
            <td>{{$user->created_at}}</td>
            <td>
                <a href="{{route('admin.user.edit',['id' => $user->id])}}"><i class="fas fa-user-edit"></i></a>
                <a href="{{route('admin.user',['id' => $user->id])}}"><i class="far fa-eye"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>