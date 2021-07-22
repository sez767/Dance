@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Зали </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/halls/create') }}" class="btn btn-success btn-sm" title="Додати нову залу">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати нову залу
                        </a>
                        <form method="GET" action="{{ url('/admin/halls') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>#</th><th>Назва</th><th>Площа</th><th>Покриття</th><th>Ціна</th>
                                </tr>
                                </thead>
                                <tbody class="my-width">
                                @foreach($hall as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><p style="width:100px; overflow: hidden">{{ $item->title }}</p></td>
                                        <td><p style="width:100px; overflow: hidden">{{ $item->area }}</p></td>
                                        <td><p style="width:100px; overflow: hidden">{{ $item->coating }}</p></td>
                                        <td><p style="width:100px; overflow: hidden">{{ $item->price }}</p></td>
                                        <td>
                                            <a href="{{ url('/admin/halls/' . $item->id) }}" title="Переглянути залу"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Переглянути</button></a>
                                            <a href="{{ url('/admin/halls/' . $item->id . '/edit') }}" title="Редагувати залу"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                                            <form method="POST" action="{{ url('/admin/halls' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити залу" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $hall->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
