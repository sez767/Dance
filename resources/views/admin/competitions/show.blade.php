@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Змагання {{ $competition->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/competitions/') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/competitions/' . $competition->id . '/edit') }}" title="Редагувати змагання"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                        <form method="POST" action="{{ url('admin/competitions' . '/' . $competition->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Видалити змагання" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
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
                                
                                <tr><th> Змагання </th><td> {{ $competition->title }} </td></tr>
                                <tr><th> Місто </th><td> {{ $competition->city }} </td></tr>
                                <tr>
                                    <th> Стилі танців </th>
                                    <td>  
                                        @foreach($competition->dances as $dn)
                                            {{$dn->title}}
                                        @endforeach
                                    </td>
                                </tr>
                                <tr><th> Дата початку</th><td> {{ $competition->date_begin }} </td></tr>
                                <tr><th> Дата закінчення</th><td> {{ $competition->date_end }} </td></tr>
                                <tr><th> Дата закінчення реєстрації</th><td> {{ $competition->date }} </td></tr>
                                <tr><th> Адреса </th><td> {{ $competition->address }} </td></tr>
                                <tr><th> Контакти </th><td> {{ $competition->contacts }} </td></tr>
                                <tr><th> Організатори </th><td> {{ $competition->organizers }} </td></tr>
                                <tr><th> Внесок учасника </th><td> {{ $competition->contribution }} грн.</td></tr>
                                <tr><th> Умови участі </th><td> {{ $competition->conditions }}</tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
