@extends('layouts.app') @section('content')
<div class="container">
    <div class="col">
        <div class="card" style="width: 105%">
            <div class="card-header">Підкатегорії категорії товару "{{$category->maincategory}}"</div>
            <div class="card-body">
                <a href="{{ url('/admin/categories') }}" title="Back"
                    ><button class="btn btn-warning btn-sm">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>Назад
                    </button></a>
                <br/>
                <div class="contain">
                    <div class="row margin">
                        <a href="{{ url('/admin/subcategories/create/'.$category->id) }}"
                            class="btn btn-success btn-sm addCat"
                            title="Add New">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати
                            нову підкатегорію
                        </a>
                    </div>
                </div>
                <!-- <div class="contain">
                    <div class="row margin">
                        <a href="{{ url('/admin/categories/create') }}"
                            class="btn btn-success btn-sm addCat"
                            title="Add New">
                            <i class="fa fa-plus" aria-hidden="true"></i> Додати
                            нову категорію
                        </a>
                    </div>
                </div> -->
                
                <div class="contain">
                    <!-- <div class="row margin">
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
                    </div> -->
                    <div class="border ">
                        <!-- <p class="label smallfield">
                            Підкатегорії {{$category->maincategory}}
                        </p> -->
                        @isset($category->subcategories)
                        @foreach($category->subcategories as $subcategory)
                        
                        <div class="row margin">
                        <div class="border sm smallfield col-md-1 btn-sm ">
                                <span>{{ $loop->iteration }}</span>
                        </div>
                            <div class="border sm smallfield col-md-6 btn-sm ">
                               
                                <span>{{$subcategory->subcategory}}</span>
                            </div>
                            <a href="{{ url('/admin/subcategories/edit/' . $subcategory->id)}}"
                            title="Редагувати"><button class="btn btn-primary btn-sm ">
                                <i class="fa fa-pencil-square-o"aria-hidden="true"></i>
                                Редагувати
                            </button></a>
                        <form method="POST"
                            action="{{ url('/admin/subcategories/'.$subcategory->id)}}"
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
                    
                    @endforeach @endisset
                    </div>
                </div>
               
                
            </div>
        </div>
    </div>
</div>
@endsection
