<h2>Detalls Parking {{$parkings->name}}</h2>

<table>
    <tr>
        <td><strong>Id</strong> </td>
        <td>{{$parkings->id}}</td>
    </tr>
    <tr>
        <td><strong>Nom Parking</strong> </td>
        <td>{{$parkings->name}}</td>
    </tr>
    <tr>
        <td><strong>Adressa Parking</strong> </td>
        <td>{{$parkings->address}}</td>
    </tr>
    <tr>
        <td><strong>Ciutat</strong> </td>
        <td>{{$parkings->ciutat}}</td>
    </tr>
    <tr>
        <td><strong>Capacitat Parking</strong> </td>
        <td>{{$parkings->capacitat}}</td>
    </tr>
    <tr>
        <td><strong>Latitud i Longitud</strong> </td>
        <td>{{$parkings->latitud}}</td>
        <td>{{$parkings->longitud}}</td>
    </tr>
    <tr>
        <td><strong>Hores Obertura i Tancament</strong> </td>
        <td>{{$parkings->horaObertura}}</td>
        <td>{{$parkings->horaTancament}}</td>
    </tr>
    
</table>
<br>

Zona del parking:

<table>
    @foreach($zonas as $zona)
    <tr >
        <td><a href="/zona/llista/{{$zona->id}}">{{$zona->nom}}</a></td>
    </tr>
    @endforeach
</table>