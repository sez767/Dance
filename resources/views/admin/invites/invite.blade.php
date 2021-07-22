@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Запрошення модератора </div>
                    <div class="card-body">{{$new_user}}

                        <form action="{{ route('invite') }}" method="post">
                                 {{ csrf_field() }}
                            <input type="email" name="email" value="{{ isset($invite->email) ? $invite->email : ''}}"/>
                            <button type="submit">Відправити запрошення</button>
                        </form>
                        <br>
                        <a href="{{ url('/admin/schools') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Не відправляти запрошення</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        let user=document.getElementById('user').value;
        document.getElementById('new_user_id').value=user;

    </script>
@endsection

