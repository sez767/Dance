@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header"> Відгуки </div>
                    <div class="card-body">
                        
                        </a>
                        <form method="GET" action="{{ url('/admin/feedbacks') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                   <th>Відгук</th>
                                </tr>
                                </thead>
                                <tbody class="my-width">
                                @foreach($feedbacks as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><p style="width:165px; overflow: hidden">{{ $item->feedback}}</p></td>
                                       
                                        <td>
                                            <a href="{{ url('/admin/feedbacks/' . $item->id) }}" title="Переглянути відгук"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Переглянути</button></a>
                                            

                                            <form method="POST" action="{{ url('/admin/feedbacks' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Видалити відгук" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Видалити</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $feedbacks->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

