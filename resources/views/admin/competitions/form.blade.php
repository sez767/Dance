

<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <label for="photo" class="control-label">{{ '' }}</label>
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($image->path) ? $image->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Змагання' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($competition->title) ? $competition->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="control-label">{{ 'Місто' }}</label>
    <input class="form-control" name="city" type="text" id="city" value="{{ isset($competition->city) ? $competition->city : old('city')}}" >
    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dance_style') ? 'has-error' : ''}}">
    <label for="dance_style" class="control-label">{{ 'Стилі танців' }}</label>
    <select class="form-control sel" name="dance_style[]" multiple="multiple">
        @foreach($dances as $dnc)
            <option value="{{$dnc->id}}"
            @isset($competition->dances)
            {{ old('dance_style',$competition->dances)->contains($dnc->id) ? 'selected' : '' }}
            @endisset
            >
            {{$dnc->title}}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group {{ $errors->has('date_begin') ? 'has-error' : ''}}">
    <label for="date_begin" class="control-label">{{ 'Дата початку' }}</label>
    <input class="form-control" name="date_begin" type="date" id="date_begin" value="{{ isset($competition->date_begin) ? $competition->date_begin : old('date_begin')}}" >
    {!! $errors->first('date_begin', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date_end') ? 'has-error' : ''}}">
    <label for="date_end" class="control-label">{{ 'Дата закінчення' }}</label>
    <input class="form-control" name="date_end" type="date" id="date_end" value="{{ isset($competition->date_end) ? $competition->date_end : old('date_end')}}" >
    {!! $errors->first('date_end', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Дата закінчення  реєстрації' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($competition->date) ? $competition->date : old('date')}}" >
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Адреса' }}</label>
    <input class="form-control" name="address" type="text" id="address" value="{{ isset($competition->address) ? $competition->address : old('address')}}" >
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contacts') ? 'has-error' : ''}}">
    <label for="contacts" class="control-label">{{ 'Контакти' }}</label>
    <input class="form-control" name="contacts" type="tel" id="contacts" pattern="^[0-9,+,/-]{5,20}$" value="{{ isset($competition->contacts) ? $competition->contacts : old('contacts')}}" >
    {!! $errors->first('contacts', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('organizers') ? 'has-error' : ''}}">
    <label for="organizers" class="control-label">{{ 'Організатори' }}</label>
    <input class="form-control" name="organizers" type="text" id="organizers"  value="{{ isset($competition->organizers) ? $competition->organizers : old('organizers')}}" >
    {!! $errors->first('organizers', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contribution') ? 'has-error' : ''}}">
    <label for="contribution" class="control-label">{{ 'Внесок учасника' }}</label>
    <input class="form-control" name="contribution" type="text" id="contribution" value="{{ isset($competition->contribution) ? $competition->contribution : old('contribution')}}" >
    {!! $errors->first('contribution', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('conditions') ? 'has-error' : ''}}">
    <label for="conditions" class="control-label">{{ 'Умови участі' }}</label>
    <input class="form-control"  name="conditions" type="text" id="conditions" value="{{ isset($competition->conditions) ? $competition->conditions : old('conditions')}}">
    {!! $errors->first('conditions', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>

<script>
$(document).ready(function() {
    $('.sel').select2();
});

</script>
