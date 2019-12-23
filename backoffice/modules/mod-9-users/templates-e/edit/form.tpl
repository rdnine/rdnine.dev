<form class="w-100" method="post" name="form" id="form" enctype="multipart/form-data">
	<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		<li class="nav-item">
			<a class="au-btn au-btn-icon au-btn--default active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">{c2r-lg-info}</a>
		</li>
		<span class="block all-15"></span>
		<li class="nav-item">
			<a class="au-btn au-btn-icon au-btn--default" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">{c2r-lg-auth}</a>
		</li>
	</ul>
	<div class="tab-content" id="pills-tabContent">
		<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			<div class="row">
				<div class="col">
					<!--USERNAME FIELD-->
					<div>
						<div class="form-group">
							<div class="spacer all-15"></div>
							<label for="inputName">{c2r-lg-name}</label>
							<input type="text" class="form-control" id="inputName" name="inputName" value="{c2r-username}">
						</div>
					</div>
					<!--HIDDEN FIELD BECAUSE PASSWORD WAS AUTOCOMPLETING (the autocomplete="off" rule was not being respected on firefox)-->
					<input type="text" style="display:none">
				</div>
				<div class="col">
					<!--EMAIL FIELD-->
					<div>
						<div class="form-group">
							<div class="spacer all-15"></div>
							<label for="inputEmail">{c2r-lg-email}</label>
							<input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{c2r-email}">
						</div>
					</div>
				</div>
			</div>
			<div class="spacer all-15"></div>
			<div class="row">
				<div class="col">
					<!-- RANK FIELD-->
					<div>
						<div class="form-group">
							<div class="spacer all-15"></div>
							<label for="inputRank">{c2r-lg-rank}</label>
							<select class="form-control" id="inputRank" name="inputRank">
								<option {c2r-owner-selected}>{c2r-lg-owner}</option>
								<option {c2r-manager-selected}>{c2r-lg-manager}</option>
								<option {c2r-member-selected}>{c2r-lg-member}</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="spacer all-30"></div>
			<div class="row">
				<div class="col">
					{c2r-other-info}
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			<div class="row">
				<div class="col">
					<!--NEW PASSWORD FIELD-->
					<div>
						<div class="form-group">
							<div class="spacer all-15"></div>
							<label for="inputNewpass">{c2r-lg-newpass}</label>
							<input type="password" class="form-control" id="inputNewpass" name="inputNewpass" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="col">
					<!--NEW PASSWORD CONFIRM FIELD-->
					<div>
						<div class="form-group">
							<div class="spacer all-15"></div>
							<label for="inputConfirm">{c2r-lg-confirm}</label>
							<input type="password" class="form-control" id="inputConfirm" name="inputConfirm" autocomplete="off">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col taleft">
			<div class="form-group">
				<div class="spacer all-30"></div>
				<div class="bo3-form-control custom-control custom-checkbox">
					<input type="checkbox" id="inputStatus" class="custom-control-input" name="inputStatus" {c2r-status-checked}/>
					<label class="custom-control-label" for="inputStatus">{c2r-lg-status}</label>
				</div>
			</div>
		</div>
		<div class="col taright">
			<div class="spacer all-30"></div>
			<button type="submit" class="au-btn au-btn-icon au-btn--green" name="save" id="save">
				<i class="fas fa-save" aria-hidden="true"></i><span class="block all-15"></span>{c2r-btn-save}
			</button>
			<div class="spacer all-30"></div>
		</div>
	</div>
</form>
