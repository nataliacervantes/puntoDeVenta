@extends('layouts.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}
                        <a href="{{ url('product/create')}}" class="btn btn-info" type="button" style="float: right">Crear</a>
                    </div>
                    <div class="card-body">
                        <table class="table" id="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Editar</th>
                                    <th>Ver Detalle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{ $product->name}}</td>
                                        <td>$ {{ number_format($product->price,2)}}</td>
                                        <td>{{ $product->qty}}</td>
                                        <td><a href="{{ url('product/'.$product->id.'/edit')}}"><i class="fas fa-edit"></i></a></td>
                                        <td><a type="button" href="{{ url('product/'.$product->id)}}">
                                            <i class="fas fa-eye"></i>
                                        </a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links()}}
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
                url: 'product/'+id,
                method: 'DELETE',
                data: {
                    'id' : id,
                    '_token': '{{ csrf_token()}}'
                },
                success: function(result) {
                    if(result == 'success'){
                        $('#table').load(window.location.href +' #table');
                        $('#exampleModal').modal('hide');
                    }
                }
            });
        }
    </script>
@endsection
