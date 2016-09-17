@extends('layouts.app')

    @section('title', 'Respuesta')

        @section('content')

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
        @endsection
        @push('scripts')

        <script src="{{ url('js/transaction/response.js') }}" type="text/javascript"></script>
        @endpush