@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Конкурс {{ $conquer->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/conquers/') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/conquers/' . $conquer->id . '/edit') }}" title="Редагувати конкурс"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                        <form method="POST" action="{{ url('admin/conquers' . '/' . $conquer->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Видалити конкурс" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                        </form>
                        <br/>
                        <br/>
                        <div class="container imgContainer">
                            <img src="{{asset($conquer->images[0]->path ?? '')}} "
                            onerror="this.onerror=null;
                            this.src='{{ asset('argon/noim.png') }}';">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr><th> Конкурс </th><td> {{ $conquer->title }} </td></tr>
                                <tr><th> Адреса </th><td> {{ $conquer->address }} </td></tr>
                                <tr><th> Контакти </th><td> {{ $conquer->contacts }} </td></tr>
                                <tr><th> Організатори </th><td> {{ $conquer->organizers }} </td></tr>
                                <tr><th> Внесок учасника </th><td> {{ $conquer->contribution }} </td></tr>
                                <tr><th> Умови участі </th><td> {{ $conquer->conditions }} </td></tr>
                                <tr><th> Дата </th><td> {{ $conquer->date }} </td></tr>
                                <tr><th> Ціна </th><td> {{ $conquer->price }}</tr>
                                <tr><th> Програма </th><td> {{ $conquer->program }}</tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
