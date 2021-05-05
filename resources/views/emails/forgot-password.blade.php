<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Coreon Gate email layout</title>
<style type="text/css">
	body {
		margin: 0;
		background-color: #F6F6F6;
	}
	table {
		border-spacing: 0;
	}
	td {
		padding: 0;
	}
	img {
		border: 0;
	}

	.wrapper {
		width: 100%;
		table-layout: fixed;
		background-color: #F6F6F6;
		padding: 50px 0px;
	}

	.card {
		width: 100%;
		margin: 0 auto;
		background-color: #ffffff;
		padding: 20px 50px;
		border-radius: 30px;
		max-width: 500px;
		box-shadow: 0px 0px 12px rgba(0,0,0,0.15);
		font-family: sans-serif;
	}

	@media screen and (max-width: 600px) { 

	}
</style>
</head>
<body>

	<center class="wrapper">
		<table class="card" style="width: 100%">
			<tr>
				<td>
					<table style="width: 100%">
						<tr>
							<td>
								<p style="text-align: center;">
									<img src="https://i.ibb.co/2vBq9Dm/logo.png" style="width: 100px;" alt="coreon gate" title="coreon gate">
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table style="width: 100%">
						<tr>
							<td>
								<p style="
								background-color:#02A343; 
								padding: 10px 0px; 
								text-align: center;
								font-weight: 700;
								color: #fff;
								font-size: 20px">
									FORGOT PASSWORD
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table style="width: 100%">
						<tr>
							<td>
								<p style="
								font-size: 12px;
								text-align: center;
								margin: 50px 0px 10px;">
									Use this code to reset your account password
								</p>

								<p style="
								font-size: 30px;
								font-weight: 900;
								text-align: center;
								margin: 10px 0px ;
								color: #000">
									{{ $code }}
								</p>
							</td>
						</tr>


					</table>
				</td>
			</tr>



			<tr>
				<td>
					<table style="width: 100%">
						<tr>
							<td>
								<p style="text-align: center;margin-top: 100px">
									<a href="https://www.facebook.com/coreongateinternetcafe" target="_blank" style="text-decoration: none;">
										<img src="https://i.ibb.co/PQwdQzj/facebook.png" alt="facebook" title="facebook" style="max-width: 30px;">
									</a>
									<a href="#" target="_blank" style="text-decoration: none;">
										<img src="https://i.ibb.co/XzrSK5z/twitter.png" alt="twitter" title="twitter" style="max-width: 30px;">
									</a>
									<a href="#" target="_blank" style="text-decoration: none;">
										<img src="https://i.ibb.co/HpLRJjb/instagram.png" alt="instagram" title="instagram" style="max-width: 30px;">
									</a>
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>




			<tr>
				<td>
					<table style="width: 100%">
						<tr>
							<td>
								<p style="font-size: 12px;
								text-align: center; 
								margin: 10px 0px 2px;">
									Coreon Gate Internet Cafe Inc.
								</p>
								<p style="font-size: 12px;
								text-align: center;
								margin: 2px 0px;">
									2nd floor Coreon Gate Building 
								</p>
								<p style="font-size: 12px;
								text-align: center;
								margin: 2px 0px;">
									47 Polaris St. Brgy. Bel Air, Makati City
								</p>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</center>

</body>
</html>