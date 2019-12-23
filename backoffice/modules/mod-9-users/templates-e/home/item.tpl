<div class="col-md-4">
	<div class="card">
		<div class="card-body">
			<div class="mx-auto d-block">
				<img class="rounded-circle mx-auto d-block" src="https://www.gravatar.com/avatar/{c2r-md5-mail}?s=100&r=g&d=mm" alt="{c2r-username}">
				<h5 class="text-sm-center mt-2 mb-1">{c2r-username}</h5>
				<div class="email text-sm-center">
					{c2r-email}
				</div>
			</div>
			<hr>
			<div class="card-text text-sm-center">
				<a href="{c2r-mdl-url}edit/{c2r-user-id}" class="btn btn-edit btn-action {c2r-access} bg-{c2r-rank}" role="button" title="{c2r-lg-edit}">
					<i class="zmdi zmdi-edit" aria-hidden="true"></i>
				</a>
				<a href="{c2r-mdl-url}delete/{c2r-user-id}" class="btn btn-action btn-del {c2r-access}" role="button" title="{c2r-lg-edit}">
					<i class="zmdi zmdi-delete" aria-hidden="true"></i>
				</a>
			</div>
		</div>
		<div class="card-footer">
			{c2r-rank}
			<small>
				<span class="badge badge-{c2r-status-label} float-right mt-1">{c2r-status}</span>
			</small>
		</div>
	</div>
</div>
