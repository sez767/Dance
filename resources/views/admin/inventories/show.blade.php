@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

        <div class="col">
            <div class="card">
                <div class="card-header">Перегляд {{ $inventory->title }}</div>
                <div class="card-body">

                    <a href="{{ url('/admin/inventories') }}" title="Назад"><button class="btn btn-warning btn-sm"><i
                                class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                    <a href="{{ url('/admin/inventories/' . $inventory->id . '/edit') }}" title="Редагувати"><button
                            class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            Редагувати</button></a>

                    <form method="POST" action="{{ url('admin/inventories' . '/' . $inventory->id) }}"
                        accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-sm" title="Видалити"
                            onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                aria-hidden="true"></i> Видалити</button>
                    </form>

                    <br />
                    <br />

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th> Тип реалізації</th>
                                    <td> {{ __('trans.'.$inventory->type) }} </td>
                                </tr>
                                <tr>
                                    <th> Категорія </th>
                                    <td>@isset($inventory->category){{$inventory->category->maincategory}}@endisset</td>
                                </tr>
                                <tr>
                                    <th> Підкатегорія </th>
                                    <td> @isset($inventory->subcategory){{$inventory->subcategory->subcategory}}@endisset</td>
                                </tr>
                                <div class="card" style="width: 18rem; border: 1px solid">
                                    <img class="card-img-top" src="{{asset($inventory->images[0]->path ?? '')}}"
                                        alt="Немає зображення"
                                        onerror="this.onerror=null;
                                         this.src='{{ asset('argon/noim.png') }}';">
                        
                                    <div class="card-body">
                                        <div class="card-title" style="display:flex;justify-content:space-between">
                                            <h4>{{ $inventory->title }}</h4>
                                            <h4 style="color: rgb(251, 92, 145); text-align:right">
                                                {{ $inventory->price }} грн.</h4>
                                        </div>
                                        <p class="card-text">
                                        {!!\Illuminate\Support\Str::limit(strip_tags($inventory->description), $limit = 85, $end = '...') !!}</p>
                                    </div>
                                </div>



                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection