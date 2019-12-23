<div class="spacer all-30"></div>
<div class="card">
	<div class="row card-body">
		<div class="col">
			<form action="{c2r-mdl-url}fields-add/" method="post">
				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="input-name">{c2r-name}</label>
							<input type="text" class="form-control" id="input-name" name="name" required>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="input-value">{c2r-value}</label>
							<input type="text" class="form-control" id="input-value" name="value">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="input-placeholder">{c2r-placeholder}</label>
							<input type="text" class="form-control" id="input-placeholder" name="placeholder">
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="input-sort">{c2r-sort}</label>
							<input type="number" class="form-control" id="input-sort" name="sort" value="0">
						</div>
					</div>
				</div>
				<div class="spacer all-15"></div>
				<div class="row">
					<div class="col d-flex align-items-center">
						<div class="bo3-form-control custom-control custom-checkbox">
							<input type="checkbox" id="inputRequired" class="custom-control-input" name="required"/>
							<label class="custom-control-label" for="inputRequired">{c2r-required}</label>
						</div>
					</div>
					<div class="col d-flex align-items-center">
						<div class="bo3-form-control custom-control custom-checkbox">
							<input type="checkbox" id="inputStatus" class="custom-control-input" name="status"/>
							<label class="custom-control-label" for="inputStatus">{c2r-status}</label>
						</div>
					</div>
					<div class="col taright">
						<button type="submit" class="au-btn au-btn-icon au-btn--green" name="submit"><i class="fas fa-save"></i><span class="block all-15"></span>{c2r-but-submit}</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
