@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="card-header">Додати нову категорію</div>
                    <div class="card-body">
                    <div class="page">
                        <a href="{{ url('/admin/categories') }}" title="назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <br/>
                        <br/>
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/categories') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title" class="control-label">{{ 'Введіть назву нової категорії товарів' }}</label>
                                <input class="form-control" name="maincategory" type="text" >
                                
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" 
                                value="Зберегти">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
