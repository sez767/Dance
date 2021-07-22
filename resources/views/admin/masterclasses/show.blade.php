@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Майстер-клас {{ $masterclasses->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/masterclasses') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/masterclasses/' . $masterclasses->id . '/edit') }}" title="Редагувати майстер-клас"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                        <form method="POST" action="{{ url('admin/masterclasses' . '/' . $masterclasses->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Видалити майстер-клас" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                        </form>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr><th> Заголовок </th><td> {{ $masterclasses->title }} </td></tr>
                                <tr><th> Адреса </th><td> {{ $masterclasses->address }}</td></tr>
                                <tr>
                                    <th>Відео</th><td>{{ $masterclasses->path }}</td>
                                </tr>
                                <tr>
                                    <th>Контактний телефон</th><td>{{ $masterclasses->contacts }}</td>
                                </tr>
                                <tr>
                                    <th>Вік</th><td>{{ $masterclasses->age }}</td>
                                </tr>
                                <tr>
                                    <th>Вид занять</th><td>{{ $masterclasses->kind }}</td>
                                </tr>
                                <tr>
                                    <th>Тривалість</th><td>{{ $masterclasses->duration }}</td>
                                </tr>
                                <tr>
                                    <th>Ціна</th><td>{{ $masterclasses->price }}</td>
                                </tr>
                                <tr><th> Map </th><td id="lat"> {{ $masterclasses->lat }} </td>
                                    <td id="lng"> {{ $masterclasses->lng }} </td>
                                </tr>
                                </tbody>
                            </table>
                            <div style="height: 500px" id="map">
                                <script>

                                    let MAPS_KEY = '{{ env('MAPS_API_KEY') }}';
                                    let b = document.getElementById("title");

                                    function initMap() {

                                        let myLat = parseFloat(document.getElementById("lat").textContent);
                                        let myLng = parseFloat(document.getElementById("lng").textContent);
                                        let myLatLng = {lat: myLat, lng: myLng};
                                        let map = new google.maps.Map(document.getElementById('map'), {
                                            center: {lat: 49.234, lng: 28.466},
                                            zoom: 13
                                        });

                                            let marker = new google.maps.Marker ( {
                                                position: {lat: myLat, lng: myLng},
                                                map: map
                                            } );
                                    }
                                </script>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeDXu5vfbSGqzXoBk4RyVD_iFb1tgQDlU&libraries=drawing&callback=initMap"
                                        async defer></script>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type = "text/javascript">
</script>
