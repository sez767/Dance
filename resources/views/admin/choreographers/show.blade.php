@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Хореограф {{ $choreographer->title }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/choreographers/') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/choreographers/' . $choreographer->id . '/edit') }}" title="Редагувати хореографа"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>
                        <form method="POST" action="{{ url('admin/choreographers' . '/' . $choreographer->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Видалити хореографа" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
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
                                <tr><th> Хореограф </th><td> {{ $choreographer->title }} </td></tr>
                                <tr>
                                    <th> Стилі танців </th>
                                    <td>
                                     @foreach($choreographer->dances as $dn)
                                        {{$dn->title}}
                                     @endforeach
                                    </td>
                                </tr>
                                <tr><th> Місце проживання</th><td> {{ $choreographer->living_place }} </td></tr>
                                <tr><th> Послуги </th><td> {{ $choreographer->services }} </td></tr>
                                <tr><th> Номер телефону </th><td> {{ $choreographer->number }}</tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
