<form class="tacenter" action="{c2r-mdl-url}delete/{c2r-id}" method="post">
	<div class="spacer all-15"></div>
	<div class="alert alert-danger d-block" role="alert"><i class="fas fa-exclamation-triangle"></i> {c2r-phrase}</div>
	<button type="submit" name="submit" class="au-btn au-btn-icon au-btn--red">
		<i class="fas fa-trash-alt" aria-hidden="true"></i><span class="block all-15"></span>{c2r-del}
	</button>
	<span class="block all-15"></span>
	<a href="{c2r-mdl-url}" class="au-btn au-btn-icon au-btn--yellow" role="button">
		<i class="fas fa-undo"></i><span class="block all-15"></span>{c2r-cancel}
	</a>
</form>
