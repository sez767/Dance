@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Змагання </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/competitions/create') }}" class="btn btn-success btn-sm" title="Додати нове змагання">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати нове змагання
                        </a>
                        <form method="GET" action="{{ url('/admin/competitions') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>#</th><th>Змагання</th><th>Місто</th><th>Дата</th><th>Дії</th>
                                </tr>
                                </thead>
                                <tbody class="my-width">
                                @foreach($competitions as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><h4 style="width:75px; overflow: hidden">{{ $item->title }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->city }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->date }}</h4></td>
                                        <td>
                                            <a href="{{ url('/admin/competitions/' . $item->id) }}" title="Переглянути змагання"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Переглянути</button></a>
                                            <a href="{{ url('/admin/competitions/' . $item->id . '/edit') }}" title="Редагувати змагання"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                                            <form method="POST" action="{{ url('/admin/competitions' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити змагання" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $competitions->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

