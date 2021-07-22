@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card" style="width: 105%;">
                    <div class="card-header">Новина {{ $news->title }}</div>
                    <div class="card-body">

                        <a href="{{ url('/admin/news') }}" title="Назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <a href="{{ url('/admin/news/' . $news->id . '/edit') }}" title="Редагувати новину"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                        <form method="POST" action="{{ url('admin/news' . '/' . $news->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Видалити новину" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                        </form>
                        <br/>
                        <br/>
                        <div class="container imgContainer">
                            <img src="{{asset($news->images[0]->path ?? '')}} "
                            onerror="this.onerror=null;
                            this.src='{{ asset('argon/noim.png') }}';">
                        </div>
                        <div class="table-responsive">
                            <table  class="table">
                                <tbody>
                                <tr><th> Заголовок новини </th><td> {{ $news->title }} </td></tr>
                                <!-- <tr><th> Школа </th><td> {{ $news->school }} </td></tr> -->
                                <!-- <tr><th> Опис </th><td> {{ $news->description }}</tr> -->
                                <tr><th> Текст новини</th>
                                <td id="newscontent" >{{ $news->content }}</td></tr>
                                <tr><th> Автор </th><td> {{ $news->author }}</tr>
                                <tr><th> Дата </th><td> {{ $news->date }}</tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
