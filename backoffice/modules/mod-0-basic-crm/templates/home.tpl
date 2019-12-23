<div class="table-data__tool">
	<div class="table-data__tool-left">
		<div class="rs-select2--light rs-select2--md">
			<select class="js-select2" name="property">
				<option selected="selected">All Properties</option>
				<option value="">Option 1</option>
				<option value="">Option 2</option>
			</select>
			<div class="dropDownSelect2"></div>
		</div>
		<div class="rs-select2--light rs-select2--sm">
			<select class="js-select2" name="time">
				<option selected="selected">Today</option>
				<option value="">3 Days</option>
				<option value="">1 Week</option>
			</select>
			<div class="dropDownSelect2"></div>
		</div>
		<button class="au-btn-filter">
			<i class="zmdi zmdi-filter-list"></i>filters</button>
	</div>
	<div class="table-data__tool-right">
		<button class="au-btn au-btn-icon au-btn--green au-btn--small">
			<i class="zmdi zmdi-plus"></i>add item</button>
		<div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
			<select class="js-select2" name="type">
				<option selected="selected">Export</option>
				<option value="">Option 1</option>
				<option value="">Option 2</option>
			</select>
			<div class="dropDownSelect2"></div>
		</div>
	</div>
</div>
<div class="table-responsive table-responsive-data2">
	<table class="table table-data2">
		<thead>
			<tr>
				<th>{c2r-lg-name}</th>
				<th>{c2r-lg-email}</th>
				<th>{c2r-lg-district}</th>
				<th>{c2r-lg-date}</th>
				<th>{c2r-lg-status}</th>
				<th>{c2r-lg-account}</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{c2r-list}
		</tbody>
	</table>
</div>
