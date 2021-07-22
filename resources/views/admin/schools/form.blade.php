<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <label for="photo" class="control-label">{{ '' }}</label>
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($image->path) ? $image->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('new_user') ? 'has-error' : ''}}">
    <label for="new_user" class="control-label" >{{ '' }}  </label>
    <input class="form-control" name="new_user" type="hidden" id="new_user" value="{{ isset($invite->new_user) ? $invite->new_user : ''}}">
    {!! $errors->first('new_user', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('email_user') ? 'has-error' : ''}}">
    <label for="email_user" class="control-label">{{ '' }}</label>
   @for($i=0;$i<10;$i++)
    <input class="form-control" name="email_user[{{ $i }}]" type="hidden" id="email_user" >
    @endfor
    {!! $errors->first('email_user', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('days') ? 'has-error' : ''}}">
    <label for="days" class="control-label">{{ '' }}</label>
   @for($i=0;$i<7;$i++)
       @for($j=0;$j<10;$j++)
    <input class="form-control" name="days[{{ $i }}][{{ $j }}]" type="hidden" id="days" >
       @endfor
    @endfor
    {!! $errors->first('days', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Назва' }}</label>
    <input class="form-control" name="title" type="text" id="title"
           value="{{ isset($school->title) ? $school->title : old('title')}}" required>
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('school_type') ? 'has-error' : ''}}">
    <label for="school_type" class="control-label">{{ 'Тип школи' }}</label>
    <input class="form-control" name="school_type" type="text" id="school_type"
           value="{{ isset($school->school_type) ? $school->school_type : old('school_type')}}" >
    {!! $errors->first('school_type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Опис' }}</label>
    <textarea class="form-control" rows="5" name="description" type="textarea" id="summary-ckeditor1" >{{ isset($school->description) ? $school->description : old('description')}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('supervisors') ? ' has-error' : ''}}" id="supervisor" >
        {!! Form::label('supervisors', 'Модератор', ['class' => 'control-label']) !!}
        {!! Form::select('supervisors', $supervisors, isset($selectedSupervisors) ? $selectedSupervisors : [], ['id' => 'super','class' => 'form-control ', 'multiple' => true, 'tags'=> true, 'width'=> '100%']) !!}
</div>
<br>
<div class="form-group {{ $errors->has('teachers') ? ' has-error' : ''}}">
        {!! Form::label('teachers', 'Вчитель', ['class' => 'control-label']) !!}
    <br>
       {!! Form::select('teachers[]', $teachers, isset($selectedTeachers) ? $selectedTeachers : [], ['id' => 'teacher','class' => 'form-control', 'multiple' => true]) !!}
</div>

<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label for="email" class="control-label">{{ 'Електронна пошта' }}</label>
    <input class="form-control" name="email" type="text" id="email" list="mail"
           value="{{ isset($school->email) ? $school->email : old('email')}}">
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}

</div>

<div class="form-group {{ $errors->has('contact') ? 'has-error' : ''}}">
    <label for="contact" class="control-label">{{ 'Контактний номер' }}</label>
    <input class="form-control" name="contact" type="tel" id="contact" pattern="^[0-9,+,/-]{5,20}$"
           value="{{ isset($school->contact) ? $school->contact : old('contact')}}">
    {!! $errors->first('contact', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dance_style') ? 'has-error' : ''}}">
    <label for="dance_style" class="control-label">{{ 'Стилі танців' }}</label>
    <select class="form-control sel" name="dance_style[]" multiple="multiple">
        @foreach($dances as $dnc)
            <option value="{{$dnc->id}}"
            @isset($school->dances)
            {{ old('dance_style',$school->dances)->contains($dnc->id) ? 'selected' : '' }}
            @endisset
            >
            {{$dnc->title}}
            </option>
        @endforeach
    </select>
</div>
<div>Час роботи</div>
<div class="container1">
           <a class="add_form_field0" type="button" ><i class="fa fa-plus" aria-hidden="false"></i> 
           </a>
<div class="Weekday">
@if($data!=null)
@foreach ($data as $d)
<div>
<select id ='weekdays'class="custom-select col-md-3" name="changed_day[]">
    @for($k=0;$k<7;$k++)
    @if ($d->day==$week[$k])
    <option id="currentday" class="dropdown-item"  name="changed_day[]" selected="true">@lang('trans.'.$d->day)</option>
    @else
    
    <option id="currentday" class="dropdown-item"  name="changed_day[]">@lang('trans.'.$week[$k])</option>
    @endif
    @endfor
</select>
<label  for="timein"> з </label>
<input type="time" value="{{ isset($d->start_time) ? $d->start_time : ''}}" step="600" name="changed_day[]"autofocus>
<label  for="timeof"> по </label>
<input type="time" value="{{ isset($d->finish_time) ? $d->finish_time : ''}}" step="600" name="changed_day[]"autofocus>
<a href="#" class="delete1">Видалити</a></div>
@endforeach 
@endif  
</div>
</div>
</div>
<br>
    <div class="contain">
        <label  class="control-label">{{ 'Вікові групи' }}</label>
        @if(isset($school->agegroups))
            @foreach($school->agegroups as $agegroup)
                <div class="inpDiv form-group age {{ $errors->has('age_title') ? 'has-error' : ''}}">
                    <input class="form-control w-25" name="age_title[]" type="text" id="age_title"
                        placeholder="Назва групи" value="{{ isset($agegroup->title) ? $agegroup->title : old('age_title[]')}}">
                    <input class="form-control w-20" name="age_begin[]" type="text" id="age_begin"
                        placeholder="зі скільки років" value="{{ isset($agegroup->begin) ? $agegroup->begin : old('age_begin[]')}}">
                    <input class="form-control w-20" name="age_end[]" type="text" id="age_end"
                        placeholder="до скільки років" value="{{ isset($agegroup->end) ? $agegroup->end : old('age_end[]')}}">
                    <input class="form-control w-20" name="age_price[]" type="text" id="age_price"
                        placeholder="ціна" value="{{ isset($agegroup->price) ? $agegroup->price : old('age_price[]')}}">
                    <div id="add" class="btn btn-success addrow round"><i class="fa fa-plus" aria-hidden="true"></i></div>
                    <div id="del" class="btn btn-danger delete round"><i class="fa fa-minus" aria-hidden="true"></i></div>
                </div>
            @endforeach
        @else
        <div class="inpDiv form-group age {{ $errors->has('age_title')||$errors->has('age_price') ? 'has-error' : ''}}">
                <input class="form-control w-25" name="age_title[]" type="text" id="age_title"
                    placeholder="Назва групи" value="{{ isset($agegroup->title) ? $agegroup->title : old('age_title[0]')}}">
                <input class="form-control w-20" name="age_begin[]" type="text" id="age_begin"
                    placeholder="зі скільки років" value="{{ isset($agegroup->begin) ? $agegroup->begin : old('age_begin[0]')}}">
                <input class="form-control w-20" name="age_end[]" type="text" id="age_end"
                    placeholder="до скільки років" value="{{ isset($agegroup->end) ? $agegroup->end : old('age_end[0]')}}">
                <input class="form-control w-20" name="age_price[]" type="text" id="age_price"
                    placeholder="ціна" value="{{ isset($agegroup->price) ? $agegroup->price : old('age_price[0]')}}">
                <div id="add" class="btn btn-success addrow round marg"><i class="fa fa-plus" aria-hidden="true"></i></div>
            </div>

        @endif
    </div>

<div class="form-group {{ $errors->has('lat') ? 'has-error' : ''}}">
    <label for="lat" class="control-label">{{ 'Карта' }}</label>
    <input class="form-control" name="lat" type="hidden" id="lat" value="{{ isset($school->lat) ? $school->lat : old('lat')}}">
    {!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
    <input class="form-control" name="lng" type="hidden" id="lng" value="{{ isset($school->lng) ? $school->lng : old('lng')}}">
    {!! $errors->first('lng', '<p class="help-block">:message</p>') !!}

</div>
<div>
    <div style="height: 400px" id="map"></div>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script >

       let items = [];
       let j=0;
       
        $('#super').select2({
            placeholder: 'Введіть модератора',
            tags: true,
            tokenSeparators: [',', ' '],
            insertTag:

                function (data, tag) {
                    // Insert the tag at the end of the results
                    document.getElementById("new_user").value ='Enter';
                    var id = $(data).val();
                    data.push(tag);

                    if(validateEmail(tag.text)){
                        var hoverInv = document.querySelectorAll("[id^=email_user]");
                        items.push(tag.text);
                        hoverInv[j].value=tag.text;
                        document.getElementById("new_user").value =  null;
                        j++;
                    }else if(document.getElementById("new_user").value=='Enter'|| tag===32){

                                    data.delete(tag);
                    }
                }
        } );
        function validateEmail(email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,4}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3,}))$/;
            return re.test(email);
        }

       $('#teacher').select2({
           placeholder: 'Виберіть вчителя', });

           $.fn.toggleAll = function(selector) {
    return this.each(function() {
        $(this).click(function() {
            $(selector).filter(':checkbox').prop('checked', this.checked);
        });
    });
};

$(document).ready(function() {
    var max_fields = 100;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field0");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="Weekdays " name="Weekdays"><select class="custom-select col-md-3" name="select_day[]"><option class="dropdown-item" value="mon" name="mon[]">Понеділок</option><option class="dropdown-item" value="tue" name="tue[]">Вівторок</option><option class="dropdown-item" value="wed" name="wed[]">Середа</option><option class="dropdown-item" value="thu" name="thu[]">Четвер</option><option class="dropdown-item" value="fri" name="fri[]">П\'ятниця</option><option class="dropdown-item" value="sat" name="sat[]">Субота</option><option class="dropdown-item" value="sun" name="sun[]">Неділя</option></select><label id="timein1" for="timein">з</label><input type="time" value="" step="600" name="select_day[]" autofocus><label id="timeof1" for="timeof">по</label><input type="time" value="" step="600" name="select_day[]" autofocus> <a href="#" class="delete">Видалити</a></div></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
    $(".container1").on("click", ".delete1", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
    })
});

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
         defer></script>
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>
<script>
$(function(){
    // var counter = 999;   
    document.addEventListener( 'click', function ( el ) {
        if ( el.target && el.target.classList.contains( 'addrow' ) ) {
            let div = document.createElement("DIV");
            div.classList.add('inpDiv', 'form-group', 'age');
            let inpTitle = document.createElement("INPUT");
            inpTitle.type = 'text';
            inpTitle.placeholder = 'Назва групи';
            inpTitle.name = `age_title[]`;
            inpTitle.classList.add('form-control', 'w-25');
            let inpBegin = document.createElement("INPUT");
            inpBegin.type = 'text';
            inpBegin.placeholder = 'зі скільки років';
            inpBegin.name = `age_begin[]`;
            inpBegin.classList.add('form-control', 'w-20');
            let inpEnd = document.createElement("INPUT");
            inpEnd.type = 'text';
            inpEnd.placeholder = 'до скільки років';
            inpEnd.name = `age_end[]`;
            inpEnd.classList.add('form-control', 'w-20');
            let inpPrice = document.createElement("INPUT");
            inpPrice.type = 'text';
            inpPrice.placeholder = 'Ціна';
            inpPrice.name = `age_price[]`;
            inpPrice.classList.add('form-control', 'w-20');
            let delButton = document.createElement("DIV");
            delButton.classList.add('btn','btn-danger','delete','marg');
            delButton.innerHTML = '<i class="fa fa-minus" aria-hidden="true"></i>';    
            div.appendChild(inpTitle)
            div.appendChild(inpBegin)
            div.appendChild(inpEnd)
            div.appendChild(inpPrice)
            div.appendChild(delButton)
            let targrtdiv = el.target.closest('.inpDiv');    
            let alldiv = targrtdiv.closest('.contain');
            alldiv.appendChild(div);
            // counter+=1;
        }
    })
    document.addEventListener( 'click', function ( el ) {
     if ( el.target && el.target.classList.contains( 'delete' ) ) {
       let olddiv = el.target.closest('.inpDiv');
       olddiv.parentNode.removeChild(olddiv);
  
     }
   });
})
$(document).ready(function() {
    $('.sel').select2();
});
</script>
