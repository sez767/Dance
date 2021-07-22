@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Майстер-класи </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/masterclasses/create') }}" class="btn btn-success btn-sm" title="Додати новий майстер-клас">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати новий майстер-клас
                        </a>
                        <form method="GET" action="{{ url('/admin/masterclasses') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>#</th><th>Майстер-клас</th><th>Адреса</th><th>Контакти</th>
                                </tr>
                                </thead>
                                <tbody class="my-width">
                                @foreach($masterclasses as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><h4 style="width:75px; overflow: hidden">{{ $item->title }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->address }}</h4></td>
                                        <td><h4 style="width:120px; overflow: hidden">{{ $item->contacts }}</h4></td>
                                        <td>
                                            <a href="{{ url('/admin/masterclasses/' . $item->id) }}" title="Переглянути майстер-клас"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Переглянути</button></a>
                                            <a href="{{ url('/admin/masterclasses/' . $item->id . '/edit') }}" title="Редагувати майстер-клас"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                                            <form method="POST" action="{{ url('/admin/masterclasses' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити майстер-клас" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $masterclasses->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

