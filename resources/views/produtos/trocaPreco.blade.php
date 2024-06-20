@extends('layouts.template')
@section('titulo')
    Troca Preço
@endsection

@section('conteudo')
    <div class="card shadow">
        <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
            <div class="col-md-3">
                <h4>
                    <span class="span-title text-primary">Troca Preço</span>
                </h4>
            </div>
            <div class="ms-auto">
                <div class="d-flex flex-column flex-sm-row align-items-center">
                    <div class="row g-3 align-items-center mx-1">
                        <div class="col-12 col-sm-auto">
                            <label for="dataTroca" class="col-form-label">Data de Troca:</label>
                        </div>
                        <div class="col-12 col-sm-auto d-flex">
                            <input type="date" id="dataTroca" name="dataTroca" class="form-control">
                            <button id="btn" class="btn btn-primary ms-2">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="container">
                        <div class="row" id="inputs-container">
                            @foreach ($dadosResponse as $dado)
                                <div class="col-md-4 mb-3 d-flex">
                                    <div class="card shadow text-center h-100"
                                        style="width: 20rem; background-color: #b9c8f4;background-image: linear-gradient(180deg, #4787e1 10%, #197beaee 100%);background-size: cover;color: #ddf0e7;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $dado->dscprod }}</h5>
                                            <input hidden type="text" id="codigo-{{ $loop->index }}"
                                                value="{{ $dado->codprod }}">
                                            <input hidden type="text" id="terminal-{{ $loop->index }}"
                                                value="{{ $dado->terminal }}">
                                            <input hidden type="text" id="codemp-{{ $loop->index }}"
                                                value="{{ $dado->codemp }}">

                                            <label for="">A vista - R$ {{ $dado->avista }} </label>
                                            <input class="form-control" type="number"
                                                placeholder="Digite o novo preço a vista aqui"
                                                id="avista-{{ $loop->index }}" name="avista-{{ $loop->index }}">
                                            <label for=""> A Prazo - R$ {{ $dado->aprazo }}</label>
                                            <input class="form-control" type="number"
                                                placeholder="Digite o novo preço a prazo aqui"
                                                id="aprazo-{{ $loop->index }}" name="aprazo-{{ $loop->index }}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let btn = document.getElementById('btn');
            const dadosJson = @json($dadosJson);
            const user = @json($usuario);
            let requestBody = {};
            let dateInput = document.getElementById('dataTroca');

            dateInput.addEventListener('input', function() {
                const inputDate = new Date(dateInput.value);
                const currentDate = new Date();

                if (inputDate < currentDate.setHours(0, 0, 0, 0)) {
                    alert('A data não pode ser menor que a data atual.');
                    dateInput.value = '';
                } else {
                    let date = tratarData(dateInput.value);
                }
            });

            btn.addEventListener('click', function() {
                const data = [];
                const container = document.getElementById('inputs-container');
                const cards = container.querySelectorAll('.card-body');

                cards.forEach(card => {
                    const codigoInput = card.querySelector('input[id^="codigo"]');
                    const avistaInput = card.querySelector('input[id^="avista"]');
                    const aprazoInput = card.querySelector('input[id^="aprazo"]');
                    const terminalInput = card.querySelector('input[id^="terminal"]');
                    const codempInput = card.querySelector('input[id^="codemp"]');
                    let date = tratarData(document.getElementById('dataTroca').value);

                    if (codigoInput && avistaInput && aprazoInput && codempInput && terminalInput &&
                        date) {

                        const avista = avistaInput.value.replace(',', '.');
                        const aprazo = aprazoInput.value.replace(',', '.');

                        if (isNaN(avista) || isNaN(aprazo)) {
                            alert(
                                'Por favor, insira valores numéricos válidos para Avista e Aprazo.'
                            );
                            return;
                        }

                        const codigo = codigoInput.value;
                        const terminal = terminalInput.value;
                        const codemp = codempInput.value;

                        const produto = {
                            codprod: codigo ? codigo : null,
                            avista: avista ? avista : null,
                            aprazo: aprazo ? aprazo : null,
                            datatroca: date,
                            codemp: codemp,
                            usuario: user.email,
                            terminal: terminal
                        };

                        data.push(produto);
                    } else {
                        alert('Informe todos os campos!');
                        return;
                    }
                });
                console.log(data);
                const config = {
                    headers: {
                        Authorization: `Bearer ${user.token}`
                    }
                };
                axios.put(`http://${user.cnpj}.ddns.net:8098/api/svrpista/bicos/trocapreco`, data, config)
                    .then(function(response) {
                        console.log('Dados enviados com sucesso:', response.data);
                        alert('Dados enviados com sucesso!');
                    })
                    .catch(function(error) {
                        console.error('Erro ao enviar os dados:', error);
                        alert('Erro ao enviar os dados.');
                    });
            });
        });

        function tratarData(date) {
            const dateObj = new Date(date);
            const day = String(dateObj.getDate()).padStart(2, '0');
            const month = String(dateObj.getMonth() + 1).padStart(2, '0');
            const year = dateObj.getFullYear();
            const formattedDate = `${day}/${month}/${year}`;
            return formattedDate;
        }
    </script>
@endsection
