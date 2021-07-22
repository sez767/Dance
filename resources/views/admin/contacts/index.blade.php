@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 100%;">
                    <div class="card-header">Відправка запиту на електронну пошту </div>

                      @if($errors->any())
                                <div class="alert alert-danger">
                                   <ul>
                                       @foreach($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                  </ul>
                                </div>
                      @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ url('/admin/contacts') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <input type="text" placeholder="Full Name" required name="name">
                            </div>
                            <div class="col-md-8">
                                <input type="text" placeholder="email" required name="email">
                            </div>
                            <div class="col-md-2">
                                <textarea name="message"></textarea>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-black no-margin-bottom btn-small"
                                        type="submit">Contact</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

