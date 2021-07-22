<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <label for="photo" class="control-label">{{ '' }}</label>
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($image->path) ? $image->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
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
    <label for="title" class="control-label">{{ 'Зала' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($hall->title) ? $hall->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div> 
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Тип зали' }}</label>
    <input class="form-control" name="type" type="text" id="type" value="{{ isset($hall->type) ? $hall->type : old('type')}}" >
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('area') ? 'has-error' : ''}}">
    <label for="area" class="control-label">{{ 'Площа зали' }}</label>
    <input class="form-control" name="area" type="text" id="area" value="{{ isset($hall->area) ? $hall->area : old('area')}}" >
    {!! $errors->first('area', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('coating') ? 'has-error' : ''}}">
    <label for="coating" class="control-label">{{ 'Тип покриття' }}</label>
    <input class="form-control" name="coating" type="text" id="coating" value="{{ isset($hall->coating) ? $hall->coating : old('coating')}}" >
    {!! $errors->first('coating', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Ціна' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ isset($hall->price) ? $hall->price : old('price')}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
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
<input class="{{ $errors->has('changed_day') ? 'error' : '' }}"  type="time" value="{{ isset($d->start_time) ? $d->start_time : ''}}" step="600" name="changed_day[]"autofocus>
<label  for="timeof"> по </label>
<input class="{{ $errors->has('changed_day') ? 'error' : '' }}" type="time" value="{{ isset($d->finish_time) ? $d->finish_time : ''}}" step="600" name="changed_day[]"autofocus>
<a href="#" class="delete1">Видалити</a></div>
@endforeach 
@endif  
</div>
</div>
</div>
<br>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>

<script type="text/javascript">


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





</script>