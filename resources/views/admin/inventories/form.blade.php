
<div class="form-group {{ $errors->has('photo') ? 'has-error' : ''}}">
    <input class="form-control" name="photo" type="hidden" id="photo" value="{{ isset($inventory->images[0]->path) ? $inventory->images[0]->path : ''}}">
    {!! $errors->first('photo', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Назва' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ isset($inventory->title) ? $inventory->title : old('title')}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Опис' }}</label>
    <textarea class="form-control" rows="4" name="description" >{{ isset($inventory->description) ? $inventory->description : old('description')}}</textarea>
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="control-label">{{ 'Ціна' }}</label>
    <input class="form-control" name="price" type="text" id="price" value="{{ isset($inventory->price) ? $inventory->price : old('price')}}" >
    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('type') ? ' has-error' : ''}}">
<label for="type" class="control-label ">{{ 'Виберіть тип/типи реалізації' }}</label>
<select class="form-control selectpicker" name="type" data-toggle="select" data-placeholder="Select multiple options">
        <option value="sell" @isset($inventory){{ $inventory->type == "sell" ? 'selected' : '' }}@endisset>Продаж</option>
        <option value="change" @isset($inventory){{ $inventory->type == "change" ? 'selected' : '' }}@endisset>Обмін</option>
        <option value="inorder" @isset($inventory){{ $inventory->type == "inorder" ? 'selected' : '' }}@endisset>На замовлення</option>
</select>
</div>
<div class="form-group{{ $errors->has('category_id') ? ' has-error' : ''}}">
<label for="category_id" class="control-label">{{ 'Виберіть категорію товару' }}</label> 
<select id="select1" name="category_id" class="form-control selectpicker" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required>

    @foreach ($categories as $category)
    <option value="{{$category->id}}"
    @isset($inventory)
        @if($inventory->category->id==$category->id) selected @endif @endisset>
        {{$category->maincategory}}
        </option>
    @endforeach    
    
</select>
</div>

<div class="form-group{{ $errors->has('subcategory_id') ? ' has-error' : ''}}">
    <label for="subcategory_id" class="control-label">{{ 'Виберіть підкатегорію товару' }}</label> 
    <select id="select2" name="subcategory_id" class="form-control selectpicker" data-toggle="select" title="Simple select"required>
    @isset($inventory->category)
    @foreach ($inventory->category->subcategories as $subcategory)
    <option value="{{$subcategory->id}}"
        @if($inventory->subcategory_id==$subcategory->id) selected @endif>
        {{$subcategory->subcategory}}
        </option>
    @endforeach 
    @endisset  
    </select>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Оновити' : 'Створити' }}">
</div>
