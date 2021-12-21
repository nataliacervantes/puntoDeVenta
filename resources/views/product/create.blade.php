@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header">{{ __('Dashboard') }}</div>
                @if (isset($product))
                    {!! Form::open(['url'=>'product/'.$product->id,'method'=>'PUT','files'=>'true']) !!}
                @else
                    {!! Form::open(['url'=>'product']) !!}
                @endif
                    <div class="card-body">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            @if (isset($product))
                                {!! Form::text('name', $product->name, ['class'=>'form-control']) !!}
                            @else
                                {!! Form::text('name', '', ['class'=>'form-control']) !!}
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('precio', 'Precio') !!}
                            @if (isset($product))
                                {!! Form::number('price', $product->price, ['class'=>'form-control']) !!}
                            @else
                                {!! Form::number('price', '', ['class'=>'form-control']) !!}
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('cantidad', 'Cantidad') !!}
                            @if (isset($product))
                                {!! Form::hidden('id', $product->id) !!}
                                {!! Form::number('qty', $product->qty, ['class'=>'form-control']) !!}
                            @else
                                {!! Form::number('qty', '', ['class'=>'form-control']) !!}
                            @endif
                        </div>
                        <div class="form-group ">
                            {!! Form::label('image', 'Imagen 1') !!}
                            {!! Form::text('image','',['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('image2', 'Imagen 2') !!}
                            {!! Form::text('image2','', ['class'=>'form-control']) !!}
                        </div>
                        
                        <button class="btn btn-success" type="submit">Crear</button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
