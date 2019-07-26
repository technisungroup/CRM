<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"></link>
<table class="table-bordered">
    <thead>
        <tr>
            <th>Module</th>
            <th>Permissions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataArray as $modules)
        <tr>
            <th>{{ $modules['module'] }}</th>
            <td>
                @foreach($modules['permissions'] as $permissions)
                    {{ $permissions['permission'].' ' }}
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
