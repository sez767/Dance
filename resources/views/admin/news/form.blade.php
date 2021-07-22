<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($image->path) ? $image->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Назва новини' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($news->title) ? $news->title : ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
    <label for="content" class="control-label">{{ 'Текст новини' }}</label>
    <textarea class="form-control" rows="5" name="content" type="textarea" id="summary-ckeditor1" >{{ isset($news->content) ? $news->content : ''}}</textarea>
    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('author') ? 'has-error' : ''}}">
    <label for="author" class="control-label">{{ 'Автор' }}</label>
    <input class="form-control" name="author" type="text" value="{{ isset($news->author) ? $news->author : ''}}">
    {!! $errors->first('author', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
    <label for="date" class="control-label">{{ 'Дата' }}</label>
    <input class="form-control" rows="5" name="date" type="date" value="{{ isset($news->date) ? $news->date : ''}}">
    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>
