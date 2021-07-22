

<div class="form-group {{ $errors->has('path') ? 'has-error' : ''}}">
    <label for="path" class="control-label">{{ 'Відео' }}</label>
    <input class="form-control" name="path" type="text" id="path" value="{{ isset($masterclasses->path) ? $masterclasses->path : old('path')}}" >
    {!! $errors->first('path', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Назва' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($masterclasses->title) ? $masterclasses->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contacts') ? 'has-error' : ''}}">
    <label for="contacts" class="control-label">{{ 'Контактний номер' }}</label>
    <input class="form-control" name="contacts" type="tel" id="contacts" pattern="^[0-9,+,/-]{5,20}$" value="{{ isset($masterclasses->contacts) ? $masterclasses->contacts : old('contacts')}}" >
    {!! $errors->first('contacts', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
    <label for="age" class="control-label">{{ 'Вік' }}</label>
    <input class="form-control" name="age" type="date" id="age" value="{{ isset($masterclasses->age) ? $masterclasses->age : old('age')}}" >
    {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('kind') ? 'has-error' : ''}}">
    <label for="kind" class="control-label">{{ 'Вид занять' }}</label>
    <input class="form-control" name="kind" type="text" id="kind" value="{{ isset($masterclasses->kind) ? $masterclasses->kind : old('kind')}}" >
    {!! $errors->first('kind', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('duration') ? 'has-error' : ''}}">
    <label for="duration" class="control-label">{{ 'Тривалість' }}</label>
    <input class="form-control" name="duration" type="text" id="duration" value="{{ isset($masterclasses->duration) ? $masterclasses->duration : old('duration')}}" >
    {!! $errors->first('duration', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Ціна' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ isset($masterclasses->price) ? $masterclasses->price : old('price')}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('recording') ? 'has-error' : ''}}">
    <label for="recording" class="control-label">{{ 'Тривалість запису' }}</label>
    <input class="form-control" name="recording" type="text" id="recording" value="{{ isset($masterclasses->recording) ? $masterclasses->recording : old('recording')}}" >
    {!! $errors->first('recording', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Адреса' }}</label>
    <input class="form-control" name="address" type="text" id="address" value="{{ isset($masterclasses->address) ? $masterclasses->address : old('address')}}" >
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lat') ? 'has-error' : ''}}">
    <label for="lat" class="control-label">{{ 'Map' }}</label>
    <input class="form-control" name="lat" type="hidden" id="lat" value="{{ isset($masterclasses->lat) ? $masterclasses->lat : old('lat')}}">
    {!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
    <input class="form-control" name="lng" type="hidden" id="lng" value="{{ isset($masterclasses->lng) ? $masterclasses->lng : old('lng')}}">
    {!! $errors->first('lng', '<p class="help-block">:message</p>') !!}

</div>
<div>
    <div style="height: 400px" id="map"></div>

    <script>
        let MAPS_KEY = '{{ env('MAPS_API_KEY') }}';

        function initMap() {
            let myLat = parseFloat(document.getElementById("lat").value);
            let myLng = parseFloat(document.getElementById("lng").value);


            let map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 49.234, lng: 28.466},
                zoom: 13
            });

            var marker = new google.maps.Marker({
                position: {lat: myLat, lng: myLng},
                map: map
            });
            map.addListener('click', function(e) {
                placeMarkerAndPanTo(e.latLng, map);
                let l = e.latLng.lat();
                let ln = e.latLng.lng();

                document.getElementById('lat').value = l;
                document.getElementById('lng').value = ln;



            });


        }

        function placeMarkerAndPanTo(latLng, map) {

            var marker = new google.maps.Marker({
                position: latLng,
                map: map
            });

        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeDXu5vfbSGqzXoBk4RyVD_iFb1tgQDlU&libraries=drawing&callback=initMap"
        async defer></script>
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>
