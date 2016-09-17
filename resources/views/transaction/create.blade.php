{{-- Load Layout --}}
@extends('layouts.app')

    {{-- Title Template --}}
    @section('title', 'Compra')

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
                <h1 class="hidden-xs hidden-sm">Compra Demo</h1>
                <h2 class="hidden-md hidden-lg">Compra Demo</h2>
            </div>
            <div class="col-md-12">
                <!-- Transaction -->
                <form id="transactionForm" name="transactionForm" method="POST" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <!-- Code Bank -->
                    <input type='hidden' id='bank' name='bank' />
                    <!-- Person Type -->
                    <input type='hidden' id='personType' name='personType' />
                    <!-- ID Transaction -->
                    <input type='hidden' id='transactionID' name='transactionID' />
                    
                    <!-- Required Message -->
                    <div class="row">
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            (<font class="requiredSign">*</font>) Campos obligatorios
                        </div>
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                    </div>
                    <!-- Document Type -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='documentType'>Tipo documento<font class="requiredSign">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <select class='form-control' id='documentType' name='documentType' required>
                                    <option value=""></option>
                                </select>
                                <div class="help-block"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Document -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='document'>Nro documento<font class="requiredSign">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Nro documento' autocomplete="off" type='text' class='form-control' id='document' name='document' />
                                <div class="help-block"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- First Name -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='firstName'>Nombres: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Nombres' autocomplete="off" type='text' class='form-control' id='firstName' name='firstName' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Last Name -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='lastName'>Apellidos: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Apellidos' autocomplete="off" type='text' class='form-control' id='lastName' name='lastName' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Company -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='company'>Empresa: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Empresa' autocomplete="off" type='text' class='form-control' id='company' name='company' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Email Address -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='emailAddress'>Email<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Correo electr&oacute;nico' autocomplete="off" type='email' class='form-control' id='emailAddress' name='emailAddress' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Address -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='address'>Direcci&oacute;n: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Direcci&oacute;n' autocomplete="off" type='text' class='form-control' id='address' name='address' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Country -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='country'>Pa&iacute;s<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <select class='form-control' id='country' name='country' required>
                                    <option value=""></option>
                                </select>
                                <div class="help-block with-errors"></div>
                        </div>
                        </div>
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                    </div>
                    <!-- Province -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='province'>Departamento: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Departamento' autocomplete="off" type='text' class='form-control' id='province' name='province' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- City -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='city'>Ciudad: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Ciudad' autocomplete="off" type='text' class='form-control' id='city' name='city' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='phone'>Tel&eacute;fono: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Tel&eacute;fono' autocomplete="off" type='text' class='form-control' id='phone' name='phone' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Mobile -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='mobile'>Celular: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Celular' autocomplete="off" type='text' class='form-control' id='mobile' name='mobile' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Reference -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='reference'># Factura<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='# Factura' autocomplete="off" type='text' class='form-control' id='reference' name='reference' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Amount -->
                    <div class="row">
                        <div class="form-group">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='amount'>Valor a pagar<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Valor a pagar' autocomplete="off" type='text' class='form-control' id='amount' name='amount' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                    </div>
                    <!-- Space -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
                    </div>
                    <!-- Popup Message -->
                    <div class="row">
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                            <span class="text-center"><font style="font-weight: bold;">NOTA:</font> Por favor habilite las ventanas emergenes (pop-up) en su navegador.</span>
                        </div>
                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                    </div>
                    <!-- Space -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
                    </div>
                    <!-- Buttons -->
                    <div class="row text-center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button type="button" id="pse" name="pse" class="btn btn-primary">PSE</button>
                            <button type="button" class="btn btn-warning btn-back">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>

             <div class="modal fade" id="mBank" name="mBank" tabindex="-1" role="dialog" aria-labelledby="lBank">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="modal-title sr-only" id="lAgradecimiento">Por favor seleccione</h4>
                            <div class="container-fluid">
                                <div class="col-md-12">
                                    <!-- Person Type -->
                                    <div class="row">
                                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                                        <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                            <label class='control-label' for='bankInterface'>Tipo banca<font class="requiredSign">*</font>: </label>
                                        </div>
                                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                            <select class='form-control' id='bankInterface' name='bankInterface' required>
                                                <option value=""></option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                                    </div>
                                    <!-- Bank -->
                                    <div class="row">
                                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                                        <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                            <label class='control-label' for='bankCode'>Banco<font class="requiredSign">*</font>: </label>
                                        </div>
                                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                            <select class='form-control' id='bankCode' name='bankCode' required>
                                                <option value=""></option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                                    </div>
                                    <!-- Space -->
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
                                    </div>
                                    <!-- Buttons -->
                                    <div class="row text-center">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <button type="button" id="transactionCreate" name="transactionCreate" class="btn btn-primary">Pagar </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cerrar &times;</span></button>
                        </div>
                    </div>
                </div>
            </div>
        @endsection

        {{-- Javascript Files --}}
        @push('scripts')

        <script src="{{ url('js/transaction/create.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/ajax/documentType.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/ajax/country.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/ajax/personType.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/ajax/bank.js') }}" type="text/javascript"></script>
        @endpush