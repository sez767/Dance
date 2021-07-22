@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Школи</div>
                    <div class="card-body" >
                        @can('create',App\School::class)
                        <a href="{{ url('/admin/schools/create') }}" class="btn btn-success btn-sm" title="Додати нову школу">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати нову школу
                        </a>
                        @endcan
                        <form method="GET" action="{{ url('/admin/schools') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                <tbody>
                                @foreach($schools as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td><td><h5 style="width:225px; overflow: hidden">{{ $item->description }}</h5></td>
                                        
                                        <td>
                                            <a href="{{ url('/admin/schools/' . $item->id) }}" title="Переглянути школу"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Переглянути</button></a>
                                            @can('update',$item)
                                            <a href="{{ url('/admin/schools/' . $item->id . '/edit') }}" title="Редагувати школу"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>
                                            @endcan
                                            @can('delete',$item)
                                            <form method="POST" action="{{ url('/admin/schools' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити школу" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                                @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
{{--                            <div class="pagination-wrapper"> {!! $schools->appends(['search' => Request::get('search')])->render() !!} </div>--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

