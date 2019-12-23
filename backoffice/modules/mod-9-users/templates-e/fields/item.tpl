<div class="line row">
	<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-11 d-flex">
		<div class="row flex-grow-1">
			<div class="box id col-sm-4 col-md-4 col-lg-1">
				<p><strong>{c2r-id}</strong></p>
			</div>
			<div class="box col-sm-8 col-md-8 col-lg-2">
				<p><strong>{c2r-name}</strong></p>
			</div>
			<div class="box col-sm-12 col-md-12 col-lg-2">
				<p>{c2r-value}</p>
			</div>
			<div class="box col-sm-12 col-md-12 col-lg-2">
				<p>{c2r-placeholder}</p>
			</div>
			<div class="box col-sm-4 col-md-4 col-lg-1 justify-content-center">
				<i class="fa fa-{c2r-required}"></i>
			</div>
			<div class="box col-sm-4 col-md-4 col-lg-1 justify-content-center">
				<p>{c2r-sort}</p>
			</div>
			<div class="box col-sm-4 col-md-4 col-lg-1 justify-content-center">
				<i class="fa fa-{c2r-status}"></i>
			</div>
			<div class="box date col-sm-4 col-md-4 col-lg-2">
				<p title="Created on : {c2r-date-created}">{c2r-date}</p>
			</div>
		</div>
	</div>
	<div class="action-list col-12 col-sm-12 col-md-12 col-lg-12 col-xl-1">
		<a href="{c2r-mdl-url}fields-edit/{c2r-id}" class="btn btn-action btn-edit" role="button">
			<i class="fas fa-pencil-alt" aria-hidden="true"></i>
			{c2r-but-edit}
		</a>
		<a href="{c2r-mdl-url}fields-del/{c2r-id}" class="btn btn-action btn-del" role="button">
			<i class="fas fa-trash" aria-hidden="true"></i>
			{c2r-but-delete}
		</a>
	</div>
</div>
