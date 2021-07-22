@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Додати новий товар</div>
                    <div class="card-body">
                        <div class="page">
                            <a href="{{ url('/admin/inventories') }}" title="назад"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                            <div class="container">
                                <div id="output" class="row containerImg"></div>
                                <br/>
                                <h2>Завантажити фотографію</h2>
                                <input type="file" name="image" class="image btn btn-sm" title="Завантажити фото">
                                @include('admin.cropper')
                                    @if ($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                <form method="POST" action="{{ url('/admin/inventories') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @include ('admin.inventories.form', ['formMode' => 'create'])
                                </form>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
		const select1 = document.querySelector("#select1");
    	const select2 = document.querySelector("#select2");
		const category_id = $(select1).val();
		let op = " ";
		if(select1 && select1){
        $.ajax({
            type: 'get',
            url: '/subcategories/'+category_id,
            dataType: "json",
            success: function(data){
				select2.innerHTML = ""
                for (let i = 0; i < data.length; i++){
                    op = new Option(data[i].subcategory,data[i].id);
                    select2.append(op);
                }
            }
        });
		}
    });
    </script>   

@endsection
