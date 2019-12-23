{c2r-return-message}
<div class="spacer all-30"></div>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-12 col-sm-12 col-lg-4 tacenter">
				<img src="https://www.gravatar.com/avatar/{c2r-md5-mail}?s=250&r=g&d=mm" class="rounded-circle">
				<div class="spacer all-30"></div>
				<form method="post" name="form" id="form" action="{c2r-mdl-url}delete/{c2r-user-id}" enctype="multipart/form-data">
					<!-- CHECK IF DELETE FIELD-->
					<div class="tacenter">
						<button type="submit" class="au-btn au-btn-icon au-btn--red" name="remove_btn" id="remove_btn">
							<i class="zmdi zmdi-delete" aria-hidden="true"></i><span class="block all-15"></span>{c2r-lg-remove}
						</button>
					</div>
				</form>
			</div>
			<div class="col-12 col-sm-12 col-lg-8">
				{c2r-form}
			</div>
		</div>
	</div>
</div>
