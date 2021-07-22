@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="card-header" id="title">Школа {{ $school->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/schools') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/schools/' . $school->id . '/edit') }}" title="Edit School"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>
                        @can('isModerator')
                        <form method="POST" action="{{ url('admin/schools' . '/' . $school->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete School" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                        </form>
                        @endcan
                        <br/>
                        <div class="container imgContainer">
                            <img src="{{asset($image->path ?? '')}} "
                            onerror="this.onerror=null;
                            this.src='{{ asset('argon/noim.png') }}';">
                        </div>
                        <br>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    
                                    <tr><th > Назва школи </th><td > {{ $school->title }} </td></tr>
                                    <tr><th> Тип </th><td> {{ $school->school_type }} </td></tr>
                                    <tr><th> Опис </th>
                                    <td id="newscontent" colspan="4"> {{ $school->description }} </td></tr>
                                    <tr><th> Модератор </th><td> {{ $name }} </td></tr>
                                    <tr><th> Електронна адреса </th><td> {{ $school->email }} </td></tr>
                                    <tr><th> Контакти </th><td> {{ $school->contact }} </td></tr>
                                    <tr>
                                        <th> Стилы танців </th>
                                        <td>  
                                            @foreach($school->dances as $dn)
                                                {{$dn->title}} 
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr><th> Час роботи </th><td> {{ $school->time_work }} </td></tr>
                                    <tr><th> Вікові групи </th>
                                            <td> Назва </td>
                                            <td> з </td>
                                            <td> до </td>
                                            <td> Ціна (грн) </td></tr>
                                        @foreach($school->agegroups as $ag)
                                        <tr class="marg">
                                            <th></th>
                                            <td> {{ $ag->title }} </td>
                                            <td> {{ $ag->begin }} </td>
                                            <td> {{ $ag->end }} </td>
                                            <td> {{ $ag->price }} </td>
                                        </tr>
                                        @endforeach
                                    
                                    
                                    <tr><th> Карта </th><td id="lat"> {{ $school->lat }} </td>
                                             <td id="lng"> {{ $school->lng }} </td>
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

                                                let marker = new google.maps.Marker({
                                                    position: {lat: myLat, lng: myLng} ,
                                                    map: map,
                                                    title: b.textContent
                                                });

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
