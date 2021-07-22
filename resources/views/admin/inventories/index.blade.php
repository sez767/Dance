@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 105%;">
                    <div id="indent1" class="card-header">Одяг-аксесуари </div>
                    <div id="indent2" class="card-body">
                        <a href="{{ url('/admin/inventories/create') }}" class="btn btn-success btn-sm" title="Додати новий">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати новий
                        </a>
                        <a href="{{ url('/admin/categories') }}" class="btn btn-success btn-sm" title="Категорії товарів">
                            <i class="fa fa-plus" aria-hidden="true"></i> Категорії товарів
                        </a>
                        <form method="GET" action="{{ url('/admin/inventories') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th>#</th><th></th><th>Назва</th><th>Ціна</th><th>Тип реалізації</th>
                                    <th>Категорія</th><th></th>
                                </tr>
                                </thead>
                                <tbody class="my-width">
                                @foreach($inventories as $item)
                                    <tr>
                                        <td width="1%">{{$loop->iteration}}</td>
                                        <td> <div class="imageDiv">
                                                <image src="{{asset($item->images[0]->path ?? '')}}"
                                                alt="Без зображення" class="img-thumbnail imgInDiv"
                                                onerror="this.onerror=null;
                                         this.src='{{ asset('argon/noim.png') }}';">
                                            </div>    
                                        </td>
                                        <td><p>{{ $item->title }}</p></td>
                                        <td><p>{{ $item->price }}</p></td>
                                        <td><p>{{ __('trans.'.$item->type) }}</p></td>
                                        <td><p>@isset($item->category){{ $item->category->maincategory }}@endisset</p></td>
                                        <td id="inventoryscrolldelete">
                                            <a href="{{ url('/admin/inventories/' . $item->id) }}" title="Переглянути"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>Переглянути</button></a>
                                            <a href="{{ url('/admin/inventories/' . $item->id . '/edit') }}" title="Редагувати"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редагувати</button></a>

                                            <form method="POST" action="{{ url('/admin/inventories' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити" onclick="return confirm(&quot;Видалити запис?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $inventories->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .imageDiv{
        width: 100px;
    height: 50px;
    position: relative;
    overflow: hidden;
    }
    .imgInDiv{
        position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
    width: 100%;
    }
    </style>
@endsection
