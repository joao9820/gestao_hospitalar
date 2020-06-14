<table class="table" id="{{isset($tableId) ? $tableId : ''}}">

	@php
		$color = 'light';
	@endphp

	<thead class="thead-{{$color}}">
		<tr>
			{{$thead}}
		</tr>
	</thead>
	<tbody>
		{{$tbody}}
	</tbody>
</table>