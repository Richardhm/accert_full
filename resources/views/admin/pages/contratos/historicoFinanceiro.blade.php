@if($contrato)
	<h3 class="text-center my-2">{{$contrato->clientes->nome}}</h3>	
	<table class="table table-sm mx-auto" style="width:90%;">
		<thead>
			<tr>
				<th colspan="4" class="text-center bg-white text-dark">Comissões</th>
			</tr>
			<tr>
				<th>Parcela</th>
				<th>Data</th>
				<th>Valor</th>
				<th>Status</th>
			</tr>
		</thead>	
		<tbody>
			@foreach($contrato->comissao->comissoesLancadas as $cc)
				<tr>
					<td>{{$cc->parcela}}</td>
					<td>{{date('d/m/Y',strtotime($cc->data))}}</td>
					<td>{{number_format($cc->valor,2,",",".")}}</td>
					<td>
						@if($cc->status == 0)
							<span>Não Pago</span>
						@else
							<span>Pago</span>
						@endif
					</td>
				</tr>
			@endforeach		
		</tbody>
	</table>

	<table class="table table-sm mt-2 mx-auto" style="width:90%;">
		<thead>
			<tr>
				<th colspan="4" class="text-center bg-white text-dark">Premiações</th>
			</tr>
			<tr>
				<th>Parcela</th>
				<th>Data</th>
				<th>Valor</th>
				<th>Status</th>
			</tr>
		</thead>	
		<tbody>
			@foreach($contrato->premiacao->premiacoesLancadas as $aa)
				<tr>
					<td>{{$aa->parcela}}</td>
					<td>{{date('d/m/Y',strtotime($aa->data))}}</td>
					<td>{{number_format($aa->valor,2,",",".")}}</td>
					<td>
						@if($aa->status == 0)
							<span>Não Pago</span>
						@else
							<span>Pago</span>
						@endif
					</td>
				</tr>
			@endforeach		
		</tbody>
	</table>
	
		


@else
	<p>Selecionar um Cliente para visualizar o seu historico</p>
@endif