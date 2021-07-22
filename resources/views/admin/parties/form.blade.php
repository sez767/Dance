<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($party->images[0]->path) ? $party->images[0]->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Вечірка' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($party->title) ? $party->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Дата' }}</label>
    <input class="form-control" name="date" type="date" id="date" value="{{ isset($party->date) ? $party->date : old('date')}}" >
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('program') ? 'has-error' : ''}}">
    <label for="program" class="control-label">{{ 'Програма' }}</label>
    <input class="form-control"  name="program" type="text" id="program" value="{{ isset($party->program) ? $party->program : old('program')}}">
    {!! $errors->first('program', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Ціна' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ isset($party->price) ? $party->price : old('price')}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label for="address" class="control-label">{{ 'Адреса' }}</label>
    <input class="form-control" name="address" type="text" id="address" value="{{ isset($party->address) ? $party->address : old('address')}}" >
    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>
