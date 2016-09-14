<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Place to pay</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ url('css/app.css') }}" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            .title {
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-size: 48px;
            }
            .m-b-md {
                margin-bottom: 30px;
                text-align: center;
            }
            .with-errors {
                color: red !important;
            }
        </style>
    </head>
    <body>
        <div class="flex-center">
            <div class="container-fluid">
                <div class="title m-b-md">
                    Compra Demo
                </div>
                <div class="col-md-12">
                    <form id="buy" name="buy" method="POST" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <input type='hidden' id='bank' name='bank' />
                        <input type='hidden' id='personType' name='personType' />
                        <input type='hidden' id='transactionID' name='transactionID' />
                        
                        <!-- Message Required -->
                        <div class="row">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                                (<font style="color: red;">*</font>) Campos obligatorios
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                        <!-- Document Type -->
                        <div class="row">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='documentType'>Tipo documento<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <select placeholder='Tipo documento' class='form-control' id='documentType' name='documentType' required>
                                    <option value=""></option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                        <!-- Document -->
                        <div class="row">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='document'>Nro documento<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Nro documento' autocomplete="off" type='text' class='form-control' id='document' name='document' />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                        <!-- First Name -->
                        <div class="row">
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
                        <!-- Last Name -->
                        <div class="row">
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
                        <!-- Company -->
                        <div class="row">
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
                        <!-- Email Address -->
                        <div class="row">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='emailAddress'>Email<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <input placeholder='Correo electr&oacute;nico' autocomplete="off" type='email' class='form-control' id='emailAddress' name='emailAddress'h.com" />
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                        <!-- Address -->
                        <div class="row">
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
                        <!-- Country -->
                        <div class="row">
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                            <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                <label class='control-label' for='country'>Pa&iacute;s<font style="color: red;">*</font>: </label>
                            </div>
                            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                <select placeholder='Pa&iacute;s' class='form-control' id='country' name='country' required>
                                    <option value=""></option>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                        </div>
                        <!-- Province -->
                        <div class="row">
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
                        <!-- City -->
                        <div class="row">
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
                        <!-- Phone -->
                        <div class="row">
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
                        <!-- Mobile -->
                        <div class="row">
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
                        <!-- Reference -->
                        <div class="row">
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
                        <!-- Amount -->
                        <div class="row">
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
                        <!-- Space -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">&nbsp;</div>
                        </div>
                        <!-- Menssage -->
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
                                <button type="reset" class="btn btn-warning">Restablecer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
                                        <label class='control-label' for='bankInterface'>Tipo banca<font style="color: red;">*</font>: </label>
                                    </div>
                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                        <select placeholder='Tipo banca' class='form-control' id='bankInterface' name='bankInterface' required>
                                            <option value=""></option>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                                </div>
                                <!-- Bank -->
                                <div class="row">
                                    <div class="hidden-xs hidden-sm col-md-1 col-lg-2"></div>
                                    <div class="col-xs-12 col-sm-5 col-md-3 col-lg-2">
                                        <label class='control-label' for='bankCode'>Banco<font style="color: red;">*</font>: </label>
                                    </div>
                                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                                        <select placeholder='Banco' class='form-control' id='bankCode' name='bankCode' required>
                                            <option value=""></option>
                                        </select>
                                        <div class="help-block with-errors"></div>
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
                                        <button type="button" id="pay" name="pay" class="btn btn-primary">Pagar </button>
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

        <script src="{{ url('js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/helpers.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/buy.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/documentType.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/country.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/personType.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/bank.js') }}" type="text/javascript"></script>
    </body>
</html>
