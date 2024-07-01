@extends('layouts.template')
@section('titulo')
    Troca Preço
@endsection
@section('conteudo')
    @if (session('success'))
        <div class="alert alert-success text-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger text-danger text-center">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    <div class="card shadow">
        <div class="card-header mt-3 d-flex justify-content-between flex-column flex-sm-row">
            <div class="col-md-3">
                <h4>
                    <span class="span-title text-primary">Troca Preço</span>
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="container mt-4">
                <div class="row">
                    <div class="container">
                        <div class="row" id="inputs-container">
                            @foreach ($dadosResponse as $dado)
                                <div class="col-md-4 mb-3 d-flex">
                                    <div class="card shadow text-center h-100 d-flex flex-column text-primary"
                                        style="width: 20rem; background-color: #ccc; background-size: cover;">
                                        <div class="card-body d-flex flex-column">
                                            <h3>{{ $dado->dscprod }}</h3>
                                            <p>A Vista - R$ {{ $dado->avista }}</p>
                                            <p>A Prazo - R$ {{ $dado->aprazo }}</p>
                                            <button type="button" class="btn btn-primary w-100 mt-auto"
                                                data-bs-toggle="modal" data-bs-target="#editPreco-{{ $loop->index }}">
                                                Trocar Preço
                                            </button>
                                            <x-Modal-edit-preco :dado="$dado" :index="$loop->index" />
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
