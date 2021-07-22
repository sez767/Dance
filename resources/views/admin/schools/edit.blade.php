@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="card">
                    <div class="card-header">Редагувати школу #{{ $school->id }}</div>
                    <div class="card-body">
                        <a href="{{ url('/admin/schools') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Назад</button></a>
                        <br />
                        <div class="card-body">
                        <div id="output" class="row box containerImg">
                        <img src="{{asset($school->images[0]->path ?? '')}}" class="smallImg img-thumbnailalt"
                            onerror="this.onerror=null;
                            this.src='{{ asset('argon/noim.png') }}';">
                          </div>  
                            <br/>
                            <button onclick="toggle_visibility('picture');" class="btn  btn-sm"><h2>Редагувати фотографію</h2></button>
                            <div class="box-2" id="picture" style="display: none">
                            <input type="file" name="image" class="image btn btn-sm" title="Завантажити фото">
                        </div>
                        @include('admin.cropper')
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/admin/schools/' . $school->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.schools.form', ['formMode' => 'edit'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script  type="text/javascript">
        function toggle_visibility(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
    </script>
@endsection
