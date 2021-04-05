@extends('blocos.base')

@section('pagina')

    <div class="container">
        <div class="row" style="margin-top: 60px">
			<div class="col-md-5  offset-md-1">
				<h3 style="color: #093b75">TABELA</h3>
			</div>
			<div class="col-md-5">
				<button type="button" class="btn btn-success float-right" id="abrir-modal">Inserir confronto</button>
			</div>
		</div>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table id="tabela" class="table " >
                    <thead>
                      <tr>
                        <th style="width: 50px">Posição</th>
                        <th></th>
                        <th style="width: 70px">PTS</th>
                        <th style="width: 70px">J</th>
                        <th style="width: 70px">V</th>
                        <th style="width: 70px">E</th>
                        <th style="width: 70px">D</th>
                        <th style="width: 70px">GP</th>
                        <th style="width: 70px">GC</th>
                        <th style="width: 70px">SG</th>
                      </tr>
                    </thead>
                    <tbody>
						@foreach ($data['times'] as $item)
							<tr>
								<td><i class="fas fa-chevron-down"></i></td>
								<td class="nome-time"><span>{{$loop->index + 1 }}º </span> {{$item->nome}}</td>
								<td>{{$item->pontos}}</td>
								<td>{{$item->jogos}}</td>
								<td>{{$item->vitorias}}</td>
								<td>{{$item->empates}}</td>
								<td>{{$item->derrotas}}</td>
								<td>{{$item->gols_sofridos}}</td>
								<td>{{$item->gols_feitos}}</td>
								<td>{{$item->gols_feitos - $item->gols_sofridos}}</td>
							</tr>
						@endforeach	
                    </tbody>
                </table>
            </div>
        </div>
    </div>

	<div class="modal fade" id="modalJogo"  data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title">Confronto</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<form id="confronto">
					@csrf
					<div class="row">
						<div class="col-md-12">
							<div class="form-group ">
								<div class="area-placar">
									<label>Time da casa </label><br>
									<select class="form-control float-left" name="time_casa">
										<option></option>
											@foreach ($data['timesSelect'] as $item)
												<option value="{{$item->id}}">{{$item->nome}}</option>
											@endforeach	
									</select>
									<input class="form-control float-right" name="placar_casa" type="number" min="0" step="1" value="0">
								</div>
								<div class="area-versus text-center"><strong>x</strong></div>
								<div class="area-placar">
									<label>Time visitante</label><br>
									<input class="form-control float-left" name="placar_visitante" type="number" min="0" step="1" value="0">
									<select class="form-control float-right" name="time_visitante">
										<option></option>
											@foreach ($data['timesSelect'] as $item)
												<option value="{{$item->id}}">{{$item->nome}}</option>
											@endforeach	
										</select>
									</select>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
				<button type="button" id="salvar" class="btn btn-primary">Salvar mudanças</button>
			</div>
		</div>
	</div>
</div>

	<script>

		$(document).ready(function(){

			$("#abrir-modal").click(function(){
			
				$("#modalJogo").modal();
			});

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$('#salvar').click(function (){

				let destino = "{{ route('salvar') }}"
			
				$.ajax({
					url: destino,    
					dataType: "json",
					type: "POST",
					data: $('#confronto').serialize(),
					success: function (data) {

						if(data.status == 0){
							alert(data.msg)
						}
						if(data.status == 1){
							alert(data.error[0])
						}
						if(data.status == 2){
							alert(data.msg)
							$("#tabela tbody").empty();
							var i = 0;

							$.each(data.campeonato, function( index, item ) {
					
								var gols_feitos = item['gols_feitos'];
								var gols_sofridos = item['gols_sofridos'];
								var saldo = gols_feitos - gols_sofridos;
								

								$("#tabela tbody").append('<tr><td><i class="fas fa-chevron-down"></i></td><td class="nome-time"><span>'+ ++i +'º </span>'  +item['nome']+   '</td></td><td>'+item['pontos']+'</td><td>'+item['jogos']+'</td><td>'+item['vitorias']+'</td><td>'+item['empates']+'</td><td>'+item['derrotas']+'</td><td>'+item['gols_sofridos']+'</td><td>'+item['gols_feitos']+'</td><td>'+saldo+'</td></tr>');
								
							});

							

							$('#confronto input').val(0);
							$('#confronto select').prop('selectedIndex',0);

							$("#modalJogo").modal('hide');

						}
						
					},error: function () {
						alert('Erro ao processar formulário');
					}
				
				});
			});

		});

	</script>
@endsection