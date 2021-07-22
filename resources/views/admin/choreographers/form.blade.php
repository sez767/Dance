<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($image->path) ? $image->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'ПІБ' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($choreographer->title) ? $choreographer->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('dance_style') ? 'has-error' : ''}}">
    <label for="dance_style" class="control-label">{{ 'Стилі танців' }}</label>
    <select class="form-control sel" name="dance_style[]" multiple="multiple">
        @foreach($dances as $dnc)
            <option value="{{$dnc->id}}"
            @isset($choreographer->dances)
            {{ old('dance_style',$choreographer->dances)->contains($dnc->id) ? 'selected' : '' }}
            @endisset
            >
            {{$dnc->title}}
            </option>
        @endforeach
    </select>
</div>
<div class="form-group {{ $errors->has('living_place') ? 'has-error' : ''}}">
    <label for="living_place" class="control-label">{{ 'Місце проживання' }}</label>
    <input class="form-control" name="living_place" type="text" id="living_place" value="{{ isset($choreographer->living_place) ? $choreographer->living_place : old('living_place')}}" >
    {!! $errors->first('living_place', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('experience') ? 'has-error' : ''}}">
    <label for="experience" class="control-label">{{ 'Досвід роботи' }}</label>
    <input class="form-control" name="experience" type="text" id="experience" value="{{ isset($choreographer->experience) ? $choreographer->experience : old('experience')}}" >
    {!! $errors->first('experience', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('services') ? 'has-error' : ''}}">
    <label for="services" class="control-label">{{ 'Послуги' }}</label>
    <input class="form-control" name="services" type="text" id="services" value="{{ isset($choreographer->services) ? $choreographer->services : old('services')}}" >
    {!! $errors->first('services', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
    <label for="number" class="control-label">{{ 'Номер телефону' }}</label>
    <input class="form-control" name="number" type="tel" id="number" pattern="^[0-9,+,/-]{5,20}$" value="{{ isset($choreographer->number) ? $choreographer->number : old('number')}}" >
    {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('facebook') ? 'has-error' : ''}}">
    <label for="facebook" class="control-label">{{ 'Фейсбук' }}</label>
    <input class="form-control" name="facebook" type="email" id="facebook" value="{{ isset($choreographer->facebook) ? $choreographer->facebook : ''}}" >
    {!! $errors->first('facebook', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('instagram') ? 'has-error' : ''}}">
    <label for="instagram" class="control-label">{{ 'Інстаграм' }}</label>
    <input class="form-control" name="instagram" type="email" id="instagram" value="{{ isset($choreographer->instagram) ? $choreographer->instagram : ''}}" >
    {!! $errors->first('instagram', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('twitter') ? 'has-error' : ''}}">
    <label for="twitter" class="control-label">{{ 'Твіттер' }}</label>
    <input class="form-control" name="twitter" type="email" id="twitter" value="{{ isset($choreographer->twitter) ? $choreographer->twitter : ''}}" >
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