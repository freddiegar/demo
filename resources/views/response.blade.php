<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Place to pay</title>

        <!-- Fonts -->
        <link href="{{ url('css/app.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        {{ csrf_field() }}
        <div class="modal fade" id="mThanks" name="mThanks" tabindex="-1" role="dialog" aria-labelledby="lAgradecimiento">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4 class="modal-title sr-only" id="lAgradecimiento">Agradecimiento</h4>
                        <h2>Gracias por su visita.</h2><br/><br/>
                        El estado de su transaccion es: <span style="font-weight: bold;" id="transactionState" name="transactionState"></span>.<br/>
                        <span style="color: red;" id="responseReasonText" name="responseReasonText"></span>.<br/><br/>
                        Para cerrar esta ventana haga clic <a href="#" onclick="closeWindow();">aqu&iacute;</a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cerrar &times;</span></button>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ url('js/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ url('js/response.js') }}" type="text/javascript"></script>
    </body>
</html>
