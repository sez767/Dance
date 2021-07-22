@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Партнери по танцях </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/dancepartners/create') }}" class="btn btn-success btn-sm" title="Додати нового партнера ">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати нового партнера
                        </a>
                        <form method="GET" action="{{ url('/admin/dancepartners') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control smallfield btn-sm" name="search" placeholder="Пошук..." value="{{ request('search') }}">
                                <span class="input-group-append" style="display: inline-block;vertical-align: middle;">
                                    <button class="btn btn-secondary smallfield btn-sm" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th><th>Партнери</th><th>Місце проживання</th><th>Стилі танців</th>
                                </tr>
                                </thead>
                                <tbody class="my-width">
                                @foreach($dancepartner as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><h4 style="width:75px; overflow: hidden">{{ $item->apellido }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->living_place }}</h4></td>
                                        <td>
                                            <h4>
                                                @foreach($item->dances as $dn)
                                                    {{$dn->title}}
                                                @endforeach 
                                            </h4>
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/dancepartners/' . $item->id) }}" title="Переглянути партнера"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Переглянути</button></a>
                                            <a href="{{ url('/admin/dancepartners/' . $item->id . '/edit') }}" title="Редагувати партнера"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                                            <form method="POST" action="{{ url('/admin/dancepartners' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити партнера" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $dancepartner->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

