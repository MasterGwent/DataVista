<!DOCTYPE html>
<html>
<head>
    <title>Client List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 30vh;
            background-color: #f7f7f7;
        }
        .container {
            width: 90%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        h1 {
            margin-top: 0;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<form method="POST" action="{{ route('logout') }}" class="logout-button">
    @csrf
    <button type="submit">Logout</button>
</form>

<div class="container">
    <h1>Client List</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
        <tr>
            <th>Account Number</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Surname</th>
            <th>Birth Date</th>
            <th>INN</th>
            <th>Responsible Person</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->number }}</td>
                <td>{{ $client->lastname }}</td>
                <td>{{ $client->firstname }}</td>
                <td>{{ $client->surname }}</td>
                <td>{{ $client->birthdate }}</td>
                <td>{{ $client->inn }}</td>
                <td>{{ $client->name_is_responsible }}</td>
                <td>
                    <form method="POST" action="{{ route('clients.updateStatus', $client->id) }}">
                        @csrf
                        <select name="status" onchange="this.form.submit()">
                            <option value="Не в работе" {{ $client->status == 'Не в работе' ? 'selected' : '' }}>Не в работе</option>
                            <option value="В работе" {{ $client->status == 'В работе' ? 'selected' : '' }}>В работе</option>
                            <option value="Отказ" {{ $client->status == 'Отказ' ? 'selected' : '' }}>Отказ</option>
                            <option value="Сделка закрыта" {{ $client->status == 'Сделка закрыта' ? 'selected' : '' }}>Сделка закрыта</option>
                        </select>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
