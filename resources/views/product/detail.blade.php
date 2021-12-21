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
                <div class="card-body">
                    <div class="form-group row">
                        {!! Form::label('id', 'Id',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                          {!! Form::label('id', $product->id, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('nombre', 'Nombre',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                          {!! Form::label('name', $product->name, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('precio', 'Precio',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                          {!! Form::label('price', $product->price, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('cantidad', 'Cantidad',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                          {!! Form::label('qty', $product->qty, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('creacion', 'Fecha de Creación',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-10">
                          {!! Form::label('created_at', $product->created_at, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    @if (isset($images))
                        @foreach ($images as $image)
                            <img src="{{ asset($image->image)}}" alt="">
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <a  href="{{ url('home')}}" class="btn btn-success" type="submit">Volver</a>
                        </div>
                        <div class="col-md-6">
                            <a type="button" class="btn btn-danger" data-whatever="{{ $product->id }}" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            ¿Estás seguro que deseas eliminar el producto?
            </div>
            <div class="modal-footer">
                    {!! Form::hidden('idM', '', ['id'=>'id']) !!}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" onclick="deleteProduct()" class="btn btn-primary">confirmar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            $('#id').val(recipient);
        });

        function deleteProduct(){
            var id = $('#id').val();
            // alert(id)

            $.ajax({
                url: '/product/'+id,
                method: 'DELETE',
                data: {
                    'id' : id,
                    '_token': '{{ csrf_token()}}'
                },
                success: function(result) {
                    if(result == 'success'){
                        window.location.href = "/home";
                    }
                }
            });
        }
    </script>
@endsection
