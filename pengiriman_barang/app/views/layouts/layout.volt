<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		{{get_title()}}
		{{ assets.outputCss('headerCss') }}
		{{ assets.outputJs('headerJs') }}
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Learning Phalcon</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>{{ link_to("home", "Home") }}</li>
						<li>{{ link_to("about_us", "About Us") }}</li>
						<li>{{ link_to("contact_us", "Contact Us") }}</li>
					</ul>
					<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="Search...">
					</form>
				</div>
			</div>
		</div>
 
		<div class="container-fluid">
			<div class="row">
				<!-- content -->
				<div class="col-sm-12 col-sm-offset-3 col-md-12 col-md-offset-2 main">
					{{ content() }}
				</div>
			</div>
		</div>
		{{ assets.outputJs('footer') }}
	</body>
</html>