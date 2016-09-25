{{-- Load Layout --}}
@extends('layouts.app')

    {{-- Title Template --}}
    @section('title', 'Pa&iacute;s')

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
                <h1 class="hidden-xs hidden-sm">Paises</h1>
                <h2 class="hidden-md hidden-lg">Paises</h2>
            </div>
            <div class="col-md-12">
                <div class="row text-right">
                    <a href="{{ url('/country/create') }}"><button class="btn btn-success">Agregar</button></a>
                </div>
            </div>
            <div class="col-md-12">
                @if($rows->count() == 0)
                <span class="text-center">No existen registros</span>
                @else
                <form method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>C&oacute;digo</th>
                            <th>Nombre</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rows as $row)
                            <tr>
                                <td>{{ $row['id'] }}</td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    <a href="{{ url('/country/' . $row['id'] . '/edit') }}"><button class="btn btn-primary">Editar</button></a>
                                    <button class="btn btn-danger countryDelete" id="{{ $row['id'] }}">Eliminar</button>
                                </td>
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

        <script src="{{ url('js/country.js') }}" type="text/javascript"></script>
        @endpush