<form class="tacenter" action="{c2r-mdl-url}fields-del/{c2r-id}" method="post">
	<div class="spacer all-15"></div>
	<div class="alert alert-danger d-block" role="alert"><i class="fas fa-exclamation-triangle"></i> {c2r-phrase}</div>
	<button type="submit" name="submit" class="btn btn-danger btn-cancel">
		<i class="fas fa-trash-alt" aria-hidden="true"></i><span class="block all-15"></span>{c2r-del}
	</button>
	<span class="block all-15"></span>
	<a href="{c2r-mdl-url}fields/" class="btn btn-warning btn-edit" role="button">
		<i class="fas fa-pencil-alt" aria-hidden="true"></i><span class="block all-15"></span>{c2r-cancel}
	</a>
</form>
