@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header"><strong>Події</strong> </div>
                    <div class="card-body">
                        <a href="{{ url('admin/competitions') }}" class="btn btn-success btn" title="Змагання">
                            <i class="fa fa-trophy" aria-hidden="true"></i>   Змагання
                        </a>
                        <a href="{{ url('admin/conquers') }}" class="btn btn-success btn" title="Конкурси">
                            <i class="fa fa-star" aria-hidden="true"></i>   Конкурси
                        </a>
                        <a href="{{ url('admin/parties') }}" class="btn btn-success btn" title="Вечірки">
                            <i class="fa fa-birthday-cake" aria-hidden="true"></i>   Вечірки
                        </a>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

