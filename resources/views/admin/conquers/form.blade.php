<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($image->path) ? $image->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Конкурс' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($conquer->title) ? $conquer->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Адреса' }}</label>
    <input class="form-control" name="address" type="text" id="address" value="{{ isset($conquer->address) ? $conquer->address : old('address')}}" >
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contacts') ? 'has-error' : ''}}">
    <label for="contacts" class="control-label">{{ 'Контакти' }}</label>
    <input class="form-control" name="contacts" type="text" id="contacts" value="{{ isset($conquer->contacts) ? $conquer->contacts : old('contact')}}" >
    {!! $errors->first('contacts', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('organizers') ? 'has-error' : ''}}">
    <label for="organizers" class="control-label">{{ 'Організатори' }}</label>
    <input class="form-control" name="organizers" type="text" id="organizers" value="{{ isset($conquer->organizers) ? $conquer->organizers : old('organizers')}}" >
    {!! $errors->first('organizers', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('contribution') ? 'has-error' : ''}}">
    <label for="contribution" class="control-label">{{ 'Внесок учасника' }}</label>
    <input class="form-control" name="contribution" type="text" id="contribution" value="{{ isset($conquer->contribution) ? $conquer->contribution : old('contribution')}}" >
    {!! $errors->first('contribution', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('conditions') ? 'has-error' : ''}}">
    <label for="conditions" class="control-label">{{ 'Умови участі' }}</label>
    <input class="form-control" name="conditions" type="text" id="conditions" value="{{ isset($conquer->conditions) ? $conquer->conditions : old('conditions')}}" >
    {!! $errors->first('conditions', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Дата' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($conquer->date) ? $conquer->date : old('date')}}" >
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Ціна' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ isset($conquer->price) ? $conquer->price : old('price')}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('program') ? 'has-error' : ''}}">
    <label for="program" class="control-label">{{ 'Програма' }}</label>
    <input class="form-control"  name="program" type="text" id="program" value="{{ isset($conquer->program) ? $conquer->program : old('program')}}">
    {!! $errors->first('program', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>

