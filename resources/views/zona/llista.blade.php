<h2>Detalls de la {{$zonas->nom}}</h2>

<table>
    <tr>
        <td><strong>Id</strong> </td>
        <td>{{$zonas->id}}</td>
    </tr>  
    <tr>
        <td><strong>Nom</strong> </td>
        <td>{{$zonas->nom}}</td>
    </tr>
    <tr>
        <td><strong>Estat</strong> </td>
        <td>{{$zonas->nom}}</td>
    </tr>    

    $status = $boolean ? 'actiu' : 'inactiva';
    echo $status;
</table>