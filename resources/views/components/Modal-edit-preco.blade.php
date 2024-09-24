@props(['dado', 'index'])

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


<style>
    @media (max-width: 575.98px) {
        .modal-dialog-centered-sm {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 65px;
        }
    }

    @media (min-width: 576px) {
        .modal-dialog-top-lg {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            margin-top: 40px;
        }
    }

    .modal-header {
        background-color: #27293d;
        border-bottom: 1px solid #444;
    }

    .modal-title {
        color: #fff;
    }

    .modal-content {
        background-color: #1e1e2f;
        border-radius: 10px;
        color: #fff;
    }

    .form-control {
        background-color: #2b2b3c;
        border: 1px solid #444;
        color: #fff;
    }

    .form-control::placeholder {
        color: #888;
    }

    .btn-close {
        filter: invert(1);
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>

<!-- Modal -->
<div class="modal fade" id="editPreco-{{ $index }}" tabindex="-1"
    aria-labelledby="editPrecoLabel-{{ $index }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered-sm modal-dialog-top-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="editPrecoLabel-{{ $index }}">Troca Preço</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('atualiza.preco') }}" method="POST">
                @csrf
                <div class="modal-body text-primary">
                    <h5 class="card-title">{{ $dado->dscprod }}</h5>
                    <input hidden type="text" name="codigo" value="{{ $dado->codprod }}">
                    <input hidden type="text" name="terminal" value="{{ $dado->terminal }}">
                    <input hidden type="text" name="codemp" value="{{ $dado->codemp }}">

                    <label for="avista-{{ $index }}" class="mb-2 h4 ">A Vista - R$
                        {{ $dado->avista }} </label>
                    <input class="form-control mb-4 money" maxlength="4" type="text"
                        placeholder="Digite o novo preço a vista aqui" id="avista-{{ $index }}" name="avista"
                        onKeyPress="setMask(this)">

                    <label for="aprazo-{{ $index }}" class="mb-2 h4"> A Prazo - R$ {{ $dado->aprazo }}</label>
                    <input class="form-control mb-4 money" maxlength="4" type="text"
                        id="aprazo-{{ $index }}" name="aprazo" placeholder="Digite o novo preço a prazo aqui"
                        onKeyPress="setMask(this)">

                    <label for="data-{{ $index }}" class="mb-2 h4"> Data de Troca</label>
                    <input class="form-control" type="date" id="data-{{ $index }}" name="data"
                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" id="submit" disabled class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            qtdCasasDecimais = <?php echo $dado->qtdcasadecimalpreco; ?>;

            function checkInputs() {
                var avistaLength = $('#avista-{{ $index }}').val().replace(/\D/g, '').length;
                var aprazoLength = $('#aprazo-{{ $index }}').val().replace(/\D/g, '').length;

                let qtdNumerosDigitados = (qtdCasasDecimais === 2) ? 3 : 4;

                if (avistaLength == qtdNumerosDigitados && aprazoLength == qtdNumerosDigitados) {
                    console.log("era pra habilitar")
                    $('#submit').prop('disabled', false);
                } else {
                    console.log("era pra deshabilitar")
                    $('#submit').prop('disabled', true);
                }
            }

            $('#avista-{{ $index }}, #aprazo-{{ $index }}').on('keyup', function() {
                checkInputs();
            });
        })
    </script>

</div>
