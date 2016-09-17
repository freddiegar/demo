{{-- Load Layout --}}
@extends('layouts.app')

    {{-- Title Template --}}
    @section('title', 'Compras')

        @push('styles')

        {{-- Styles --}}
        <style>
            .title {
                color: #636b6f;
                font-family: Arial, sans-serif;
                font-size: 48px;
                margin-bottom: 30px;
                text-align: center;
            }
            .requiredSign {
                color: red;
            }
        </style>
        @endpush

        {{-- Page content --}}
        @section('content')

            <div class="title">
                <h1 class="hidden-xs hidden-sm">Compras</h1>
                <h2 class="hidden-md hidden-lg">Compras</h2>
            </div>
            <div class="col-md-12">
                <div class="row text-right">
                    <a href="{{ url('/transaction/create') }}"><button class="btn btn-success">Agregar</button></a>
                </div>
            </div>
            <div class="col-md-12">
                @if($rows->count() == 0)
                    <span class="text-center">No existen registros</span>
                @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Transacci&oacute;n</th>
                            <th>Estado</th>
                            <th>Descripcion</th>
                            <th>Creada</th>
                            <!--<th>&nbsp;</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                <td>{{ $row->transactionID }}</td>
                                <td>{{ $row->transactionState }}</td>
                                <td>{{ $row->responseReasonText }}</td>
                                <td>{{ $row->created_at }}</td>
                                <!--<td><a href="{{ url('/transaction/' . $row['id'] . '/edit') }}"><button class="btn btn-primary">Editar</button></a></td>-->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <center>
                    {{ $rows->links() }}
                </center>
                @endif

            </div>
        @endsection

        {{-- Javascript Files --}}
        @push('scripts')

        @endpush