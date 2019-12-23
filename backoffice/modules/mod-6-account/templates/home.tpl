<div class="spacer all-30"></div>
<div class="row">
	<div class="col-12 col-sm-12 col-lg-4">
		<div class="card tacenter">
			<div class="card-body">
				<div class="avatar-placeholder b-{c2r-rank} tacenter c-shadow">
					<img src="http://www.gravatar.com/avatar/{c2r-md5-email}?s=150&r=g&d=mm" class="rounded-circle" alt="gravatar" title="I'm the {c2r-rank} and this is my Gravatar!">
				</div>
				<div class="spacer all-30"></div>
				<div class="rank">
					<label for="rank">{c2r-lg-rank}</label>
					<h4><strong>{c2r-rank}</strong></h4>
				</div>
				<div class="spacer all-15"></div>
				<hr>
				<div class="spacer all-15"></div>
				<div class="username">
					<label for="username">{c2r-lg-username}</label>
					<h4><strong>{c2r-username}</strong></h4>
				</div>
				<div class="spacer all-30"></div>
				<div class="email">
					<label for="email">{c2r-lg-email}</label>
					<h4><strong>{c2r-email}</strong></h4>
				</div>
				<div class="spacer all-30"></div>
				<div class="date">
					<label for="date">{c2r-lg-date}</label>
					<h4 title="{c2r-full-date}"><strong>{c2r-date}</strong></h4>
				</div>
				<div class="spacer all-30"></div>
				<div class="login">
					<label for="date">{c2r-lg-login}</label>
					<h4><strong>{c2r-ip}</strong></h4>
					<h4><strong>{c2r-login-date}</strong></h4>
				</div>
			</div>
		</div>
		<div class="spacer all-30"></div>
	</div>
	<div class="col-12 col-sm-12 col-lg-8">
		<div class="card">
			<div class="card-body">
				<form method="post" action="{c2r-bo-path}/{c2r-lg}/6-account/">
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
									<h5>{c2r-lg-username-change}</h5>
								</div>
							</div>
							<div class="spacer all-15"></div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<input type="text" class="form-control" id="username" placeholder="{c2r-username-ph}" name="username">
									</div>
								</div>
							</div>
							<div class="spacer all-30"></div>
							<div class="row">
								<div class="col">
									<h5>{c2r-lg-email-change}</h5>
								</div>
							</div>
							<div class="spacer all-15"></div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<input type="text" class="form-control" id="email" placeholder="{c2r-email-ph}" name="email">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<input type="text" class="form-control" id="checkemail" placeholder="{c2r-email-confirm-ph}" name="checkemail">
									</div>
								</div>
							</div>
							<div class="spacer all-30"></div>
							<div class="other-info {c2r-info-active}">
								<div class="row">
									<div class="col">
										<h5>{c2r-lg-information-change}</h5>
									</div>
								</div>
								<div class="spacer all-15"></div>
								{c2r-list}
							</div>
						</div>

						<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
							<div class="row">
								<div class="col">
									<h5>{c2r-lg-password}</h5>
								</div>
							</div>
							<div class="spacer all-15"></div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<input type="password" class="form-control" id="oldpassword" placeholder="{c2r-old-password-ph}" name="oldPassword">
									</div>
								</div>
							</div>
							<div class="spacer all-15"></div>
							<div class="row">
								<div class="col">
									<div class="form-group">
										<input type="password" class="form-control" id="newpassword" placeholder="{c2r-password-ph}" name="newPassword">
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<input type="password" class="form-control" id="check" placeholder="{c2r-password-confirm-ph}" name="checkPassword">
									</div>
								</div>
							</div>
						</div>
						<div class="spacer all-60"></div>
						<div class="row">
							<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 taright">
								<button type="submit" class="au-btn au-btn-icon au-btn--green" name="submit">
									<i class="fas fa-save" aria-hidden="true"></i>
									<div class="block all-15"></div> {c2r-lg-save}
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="spacer all-60"></div>
