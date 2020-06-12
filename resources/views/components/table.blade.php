<table class="table">

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