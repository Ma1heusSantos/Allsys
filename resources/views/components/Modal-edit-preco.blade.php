@props(['dado', 'index'])

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
</style>

<!-- Modal -->
<div class="modal fade" id="editPreco-{{ $index }}" tabindex="-1"
    aria-labelledby="editPrecoLabel-{{ $index }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered-sm modal-dialog-top-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editPrecoLabel-{{ $index }}">Troca Preço</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('atualiza.preco') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <h5 class="card-title">{{ $dado->dscprod }}</h5>
                    <input hidden type="text" name="codigo" value="{{ $dado->codprod }}">
                    <input hidden type="text" name="terminal" value="{{ $dado->terminal }}">
                    <input hidden type="text" name="codemp" value="{{ $dado->codemp }}">

                    <label for="" class="mb-2 h4">A vista - R$ {{ $dado->avista }} </label>
                    <input class="form-control mb-4" type="text" placeholder="Digite o novo preço a vista aqui"
                        id="avista-{{ $index }}" name="avista">
                    <label for="" class="mb-2 h4"> A Prazo - R$ {{ $dado->aprazo }}</label>
                    <input class="form-control mb-4" type="text" name="aprazo"
                        placeholder="Digite o novo preço a prazo aqui">
                    <label for="" class="mb-2 h4"> Data de Troca</label>
                    <input class="form-control" type="date" name="data">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
