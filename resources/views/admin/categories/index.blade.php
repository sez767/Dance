@extends('layouts.app') @section('content')
<div class="container">
    <div class="col">
        <div class="card" style="width: 105%">
            <div class="card-header">Категорії товарів</div>
            <div class="card-body">
                <a href="{{ url('/admin/inventories') }}" title="Назад"
                    ><button class="btn btn-warning btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>Назад
                    </button></a>
                <br />
                @if (Session::has('success'))
                  <div class="alert alert-info">{{ Session::get('success') }}</div>
                @endif
                <div class="contain">
                    <div class="row margin">
                        <a href="{{ url('/admin/categories/create') }}"
                            class="btn btn-success btn-sm addCat"
                            title="Додати нову категорію">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати
                            нову категорію
                        </a>
                    </div>
                </div>
                @isset($categories) @foreach($categories as $category)
                <div class="contain">
                    <div class="row margin">
                        <div class="border smallfield col-md-8">
                            <span>{{$category->maincategory}}</span>
                        </div>
                        <a href="{{ url('/admin/categories/' . $category->id) }}"
                            title="Підкатегорії"><button class="btn btn-danger btn-sm ">
                                <i class="fa fa-pencil-square-o"aria-hidden="true"></i>
                                Підкатегорії
                            </button></a>
                        <a href="{{ url('/admin/categories/' . $category->id . '/edit') }}"
                            title="Редагувати"><button class="btn btn-primary btn-sm ">
                                <i class="fa fa-pencil-square-o"aria-hidden="true"></i>
                                Редагувати
                            </button></a>
                        <form method="POST"
                            action="{{ url('/admin/categories' . '/' . $category->id) }}"
                            accept-charset="UTF-8"
                            style="display: inline">
                            {{ method_field("DELETE") }}
                            {{ csrf_field() }}
                            <button
                                type="submit"
                                class="btn btn-danger btn-sm "
                                title="Видалити"
                                onclick='return confirm("Видалити запис?")'>
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                Видалити
                            </button>
                        </form>
                    </div>
                    <div class="border">
                        <p class="label smallfield">
                            Підкатегорії {{$category->maincategory}}
                        </p>
                        @foreach($category->subcategories as $subcategory)
                        
                        <div class="row margin">
                            <div class="label border sm smallfield col-md-8 btn-sm ">
                                <span>{{$subcategory->subcategory}}</span>
                            </div>
                           
                        </div>
                    
                    @endforeach
                    </div>
                </div>
                @endforeach @endisset
                
            </div>
        </div>
    </div>
</div>
@endsection
