@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Зала {{ $hall->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/halls/') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/halls/' . $hall->id . '/edit') }}" title="Редагувати залу"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                        <form method="POST" action="{{ url('admin/halls' . '/' . $hall->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Видалити залу" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                        </form>
                        <br/>
                        <br/>
                        <div class="container imgContainer">
                            <img src="{{asset($image->path ?? '')}} "
                            onerror="this.onerror=null;
                            this.src='{{ asset('argon/noim.png') }}';">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <!-- <tr><th> Зала </th><td> {{ $hall->title }} </td></tr> -->
                                <tr><th> Тип зали </th><td> {{ $hall->type }} </td></tr>
                                <tr><th> Площа зали</th><td> {{ $hall->area }} </td></tr>
                                <tr><th> Тип покриття </th><td> {{ $hall->coating }} </td></tr>
                                <tr><th> Ціна </th><td> {{ $hall->price }}</tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
