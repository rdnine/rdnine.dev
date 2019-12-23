<form action="{c2r-path-bo}/{c2r-lg}/{c2r-module-folder}/edit/{c2r-id}" method="post">
	<div class="card">
		<div class="card-header">
			<h4>Editing - {c2r-file}</h4>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="spacer all-15"></div>
					<div class="form-group">
						<label for="inputFile">File</label>
						<div class="input-group">
							<input type="text" class="form-control input-view-file" id="inputFile" placeholder="" value="{c2r-file}" readonly>
							<a class="input-group-addon btn btn-secondary" href="{c2r-path}/uploads/{c2r-file}" target="_blank">
								<i class="fas fa-eye" aria-hidden="true"></i>
							</a>
						</div>
					</div>
					<div class="form-group">
						<div class="spacer all-15"></div>
						<label for="inputType">Type</label>
						<input type="text" class="form-control" id="inputType" placeholder="" value="{c2r-type}" readonly>
					</div>
					<div class="form-group">
						<div class="spacer all-15"></div>
						<label for="inputModule">Module</label>
						<select class="form-control" name="inputModule">
							<option>Select one module</option>
							{c2r-modules-list}
						</select>
					</div>
					<div class="form-group">
						<div class="spacer all-15"></div>
						<label for="inputIdAss">ID Ass</label>
						<input type="number" class="form-control" id="inputIdAss" placeholder="" value="{c2r-id-ass}" name="inputIdAss">
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="spacer all-15"></div>
					<div class="form-group">
						<label for="inputDescription">Description</label>
						<input type="text" class="form-control" id="inputDescription" placeholder="" value="{c2r-description}" name="inputDescription">
					</div>
					<div class="form-group">
						<div class="spacer all-15"></div>
						<label for="inputCode">Code</label>
						<textarea class="form-control" name="inputCode" rows="1">{c2r-code}</textarea>
					</div>
					<div class="form-group">
						<div class="spacer all-15"></div>
						<label for="inputSort">Sort</label>
						<input type="number" class="form-control" id="inputSort" placeholder="" value="{c2r-sort}" name="inputSort">
					</div>
					<div class="form-group">
						<div class="spacer all-15"></div>
						<label for="inputDate">Date</label>
						<input type="text" class="form-control" id="inputDate" placeholder="YYYY-mm-dd HH:ii:ss" value="{c2r-date}" name="inputDate">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 tacenter">
				<div class="spacer all-30"></div>
				<button type="submit" class="btn btn-save btn-success btn-block" name="submit"><i class="fas fa-save"></i><span class="block all-15"></span>Save</button>
				<div class="spacer all-30"></div>
			</div>
		</div>
	</div>
</form>
