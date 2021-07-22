<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($image->path) ? $image->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('apellido') ? 'has-error' : ''}}">
    <label for="apellido" class="control-label">{{ 'ПІБ' }}</label>
    <input class="form-control" name="apellido" type="text" id="apellido" value="{{ isset($dancepartner->apellido) ? $dancepartner->apellido : old('apellido')}}" >
    {!! $errors->first('apellido', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('gender') ? ' has-error' : ''}}">
<label for="type" class="control-label ">{{ 'Стать' }}</label>
<select class="form-control selectpicker" name="gender" data-toggle="select" data-placeholder="Select multiple options">
        <option value="male" @isset($dancepartner){{ $dancepartner->gender == "male" ? 'selected' : '' }}@endisset>Чол.</option>
        <option value="female" @isset($dancepartner){{ $dancepartner->gender == "female" ? 'selected' : '' }}@endisset>Жін.</option>
</select>
</div>
<div class="form-group {{ $errors->has('dance_style') ? 'has-error' : ''}}">
    <label for="dance_style" class="control-label">{{ 'Стилі танців' }}</label>
    <select class="form-control sel" name="dance_style[]" multiple="multiple">
        @foreach($dances as $dnc)
            <option value="{{$dnc->id}}"
            @isset($dancepartner->dances)
                {{ old('dance_style',$dancepartner->dances)->contains($dnc->id) ? 'selected' : '' }}
            @endisset
            >
            {{$dnc->title}}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group {{ $errors->has('living_place') ? 'has-error' : ''}}">
    <label for="living_place" class="control-label">{{ 'Місце проживання' }}</label>
    <input class="form-control" name="living_place" type="text" id="living_place" value="{{ isset($dancepartner->living_place) ? $dancepartner->living_place : old('living_place')}}" >
    {!! $errors->first('living_place', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
    <label for="age" class="control-label">{{ 'Дата народження' }}</label>
    <input class="form-control" name="age" type="date" id="age" value="{{ isset($dancepartner->age) ? $dancepartner->age : old('age')}}" >
    {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('experience') ? 'has-error' : ''}}">
    <label for="experience" class="control-label">{{ 'Досвід' }}</label>
    <input class="form-control" name="experience" type="text" id="experience" value="{{ isset($dancepartner->experience) ? $dancepartner->experience : old('experience')}}" >
    {!! $errors->first('experience', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('participation') ? 'has-error' : ''}}">
    <label for="participation" class="control-label">{{ 'Участь у змаганнях' }}</label>
    <input class="form-control" name="participation" type="text" id="participation" value="{{ isset($dancepartner->participation) ? $dancepartner->participation : old('participation')}}" >
    {!! $errors->first('participation', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('about_yourself') ? 'has-error' : ''}}">
    <label for="about_yourself" class="control-label">{{ 'Про мене' }}</label>
    <input class="form-control" name="about_yourself" type="text" id="about_yourself" value="{{ isset($dancepartner->about_yourself) ? $dancepartner->about_yourself : old('about_yourself')}}" >
    {!! $errors->first('about_yourself', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
    <label for="number" class="control-label">{{ 'Номер телефону' }}</label>
    <input class="form-control" name="number" type="tel" id="number" pattern="^[0-9,+,/-]{5,20}$" value="{{ isset($dancepartner->number) ? $dancepartner->number : old('number')}}" >
    {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('facebook') ? 'has-error' : ''}}">
    <label for="facebook" class="control-label">{{ 'Фейсбук' }}</label>
    <input class="form-control" name="facebook" type="text" id="facebook" value="{{ isset($dancepartner->facebook) ? $dancepartner->facebook : ''}}" >
    {!! $errors->first('facebook', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('instagram') ? 'has-error' : ''}}">
    <label for="instagram" class="control-label">{{ 'Інстаграм' }}</label>
    <input class="form-control" name="instagram" type="text" id="instagram" value="{{ isset($dancepartner->instagram) ? $dancepartner->instagram : ''}}" >
    {!! $errors->first('instagram', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
    <label for="twitter" class="control-label">{{ 'Твіттер' }}</label>
    <input class="form-control" name="twitter" type="text" id="twitter" value="{{ isset($dancepartner->twitter) ? $dancepartner->twitter : ''}}" >
    {!! $errors->first('twitter', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>
<script>
$(document).ready(function() {
    $('.sel').select2();
});

</script>
