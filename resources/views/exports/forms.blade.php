@php
    $status = config('status-form');
@endphp

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Comuna</th>
        <th>Comentario</th>
        <th>Campaña</th>
        <th>Recibido</th>
        <th>Actualizado</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($forms as $form)
        <tr>
            <td>{{ $form->id }}</td>
            <td>{{ $form->name }}</td>
            <td>{{ $form->lastname }}</td>
            <td>{{ $form->phone }}</td>
            <td>{{ $form->email }}</td>
            <td>{{ $form->commune_string }}</td>
            <td>{{ $form->details }}</td>
            <td>{{ $form->campaign }}</td>
            <td>{{ $form->created_at->format('d-m-Y') }}</td>
            <td>{{ $form->updated_at->format('d-m-Y') }}</td>
            <td>{{ $status[$form->status_service]['texto'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
