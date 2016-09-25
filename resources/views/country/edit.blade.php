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
                @if(!isset($row))
                <!-- Error -->
                <div class="row">
                    <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                        <a class="btn-back"><< Volver</a>
                        <span class="text-center">No se encontro el registro</span>
                    </div>
                    <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                </div>
                @else
                <!-- Country -->
                <form id="countryForm" name="countryForm" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    
                    <!-- Required Message -->
                    <div class="row">
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            (<font class="requiredSign">*</font>) Campos obligatorios
                        </div>
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                    </div>
                    <!-- Verb -->
                    {{ method_field('POST') }}
                    <!-- ID Country -->
                    <input type='hidden' id='id' name='id' value="{{$row['id']}}" />
                    <!-- Name -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='name'>Nombre<font class="requiredSign">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Nombre' autocomplete="off" type='text' class='form-control' id='name' name='name' value="{{$row->name}}" />
                                <div class="help-block"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Space -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
                    </div>
                    <!-- Buttons -->
                    <div class="row text-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="button" id="countryUpdate" name="countryUpdate" class="btn btn-primary">Actualizar</button>
                            <button type="button" id="countryDelete" name="countryDelete" class="btn btn-danger">Eliminar</button>
                            <button type="button" class="btn btn-warning btn-back">Cancelar</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        @endsection

        {{-- Javascript Files --}}
        @push('scripts')

        <script src="{{ url('js/country.js') }}" type="text/javascript"></script>
        @endpush