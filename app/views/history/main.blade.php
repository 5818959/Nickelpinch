@extends('home.base')

@section('content')
<div class="container">
	<div class="row entry-add">
		<div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
		{{ Form::open($form_data) }}
			<fieldset>
			<div class="form-group">
				{{ Form::label('cat_1', 'Category: ') }}
				{{ Form::select('cat_1',$cats_dd,$target_cat,array('class'=>'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::label('date_range', ' Within: ') }}
				{{ Form::select('date_range',$date_range_dd,$target_range,array('class'=>'form-control')) }}
			</div>

			
			<button type="submit" class="btn btn-primary">Filter</button>

			</fieldset>
		{{ Form::close() }}

		<table class="table">
			<thead>
				<tr>
					<th>Amount</th><th>Type</th><th>Date</th><th>To/From</th>
				</tr>
			</thead>
			<tbody>
				@foreach($history as $h)
				<tr class="active">
					<td>{{ $currency . ($target_cat==$h->paid_to ? $h->total_amount : $h->amount) }}</td>
					<td>{{ $nikl_config['entry_types'][$h->type]}}</td>
					<td>{{ date('M j, Y',strtotime($h->purchase_date)) }}</td>
					<td>{{ ($target_cat==$h->paid_to ? '<span class="glyphicon glyphicon-chevron-right"></span> ' : '<span class="glyphicon glyphicon-chevron-left"></span> '). $target_name }}</td>
				</tr>
				<tr>
					<td colspan="4">{{ $h->description }} <button data-entid="{{ $h->entid }}" class="btn btn-info btn-sm pull-right get-ent-details"><span class="glyphicon glyphicon-search"></span></button></td>
				</tr>
				@endforeach
			</tbody>

		</table>

		<script id="entry-template-main" type="text/html">
			<table class="table">
				<tr><td>{date}</td><td>{type}</td><td>{description}</td></tr>
				<tr class="active"><td>{total_amount}</td><td colspan="2">{paid_to}</td></tr>
			</table>
		</script>
		<script id="entry-template-from" type="text/html">
			<tr><td>{amount}</td><td colspan="2">{ucid}</td></tr>
		</script>
		</div>
	</div>
	

</div>

@stop