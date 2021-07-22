@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Танці </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/dances/create') }}" class="btn btn-success btn-sm" title="Додати новий танець">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати новий танець
                        </a>
                        <form method="GET" action="{{ url('/admin/dances') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>#</th><th>Назва</th><th>Опис</th><th>Дії</th>
                                </tr>
                                </thead>
                                <tbody class="my-width">
                                @foreach($dances as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><p style="width:165px; overflow: hidden">{{ $item->title }}</p></td>
                                        <td><p style="width:120px; overflow: hidden">{{ $item->description }}</p></td>
                                        <td>
                                            <a href="{{ url('/admin/dances/' . $item->id) }}" title="Переглянути танець"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Переглянути</button></a>
                                            <a href="{{ url('/admin/dances/' . $item->id . '/edit') }}" title="Редагувати танець"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                                            <form method="POST" action="{{ url('/admin/dances' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити танець" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $dances->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
