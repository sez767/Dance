<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">

    {!! Form::label('name', "Ім'я", ['class' => 'control-label']) !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control', 'required' => 'required']) !!}

    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('email', 'Електронна пошта ', ['class' => 'control-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('password', 'Пароль ', ['class' => 'control-label']) !!}
    @php
        $passwordOptions = ['class' => 'form-control'];
        if ($formMode === 'create') {
            $passwordOptions = array_merge($passwordOptions, ['required' => 'required']);
        }
    @endphp
    {!! Form::password('password', $passwordOptions) !!}
    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
    {!! Form::label('role', 'Роль', ['class' => 'control-label']) !!}
    {!! Form::select('roles[]', $roles, isset($roles) ? $roles : [], ['class' => 'form-control', 'multiple' => true]) !!}

</div>
<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Оновити' : 'Зберегти', ['class' => 'btn btn-primary']) !!}
</div>
