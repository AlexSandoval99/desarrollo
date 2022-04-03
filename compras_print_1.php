<html>

	<head>
	<title>Allcant</title>
		<style type="text/css">
		body {		
			font-family: Verdana;
		}
		
		div.invoice {
		border:1px solid #ccc;
		padding:10px;
		height:740pt;
		width:570pt;
		}

		div.company-address {
			border:1px solid #ccc;
			float:rigth;
			width:200pt;
		}
		
		div.invoice-details {
			border:1px solid #ccc;
			float:right;
			width:200pt;
		}
		
		div.customer-address {
			border:1px solid #ccc;
			float:right;
			margin-bottom:50px;
			margin-top:100px;
			width:200pt;
		}
		
		div.clear-fix {
			clear:both;
			float:none;
		}
		
		table {
			width:100%;
		}
		
		th {
			text-align: left;
		}
		
		td {
		}
		
		.text-left {
			text-align:left;
		}
		
		.text-center {
			text-align:center;
		}
		
		.text-right {
			text-align:right;
		}
		
		</style>
	</head>

	<body>
	<div class="invoice">
		<div class="company-address">
			ALL'CORT
			<br />
			Ruta D027
			<br />
			Capiata
			<br />
		</div>
	
		<div class="invoice-details">
			Factura N°: 564
			<br />
			Fecha: 24/01/2012
		</div><br><br>
                <br>
                <br>
		
<!--		<div class="customer-address">
			To:
			<br />
			Mr. Bill Terence
			<br />
			123 Long Street
			<br />
			London, DC3P F3Z 
			<br />
		</div>-->
		
		<div class="clear-fix"></div>
			<table border='1' cellspacing='0'>
				<tr>
					<th width=250>Descripcion</th>
					<th width=80>Monto</th>
					<th width=100>Precio Unitario</th>
					<th width=100>Total</th>
				</tr>

			<?php
			$total = 0;
			$vat = 21;
			
			$articles = array(
						array("ROLLER","ROMANA","T. Vertical","T. Horizontal","Tradicional", "x"),
						array(1,1,2,2,1,1),
						array(65,80,70,125,210,30)
			);

			for($a=0;$a<5;$a++) {
					$description = $articles[0][$a];
					$amount = $articles[1][$a];
					$unit_price = number_format( $articles[2][$a], 2);
					$total_price = number_format( $amount * $unit_price, 2);
					$total += $total_price;
					echo("<tr>");
					echo("<td>$description</td>");
					echo("<td class='text-center'>$amount</td>");
					echo("<td class='text-right'>G$unit_price</td>");
					echo("<td class='text-right'>G$total_price</td>");
					echo("</tr>");
			}
			
			echo("<tr>");
			echo("<td colspan='3' class='text-right'>Sub total</td>");
			echo("<td class='text-right'>G" . number_format($total,2) . "</td>");
			echo("</tr>");
			echo("<tr>");
			echo("<td colspan='3' class='text-right'>IVA</td>");
			echo("<td class='text-right'>G" . number_format(($total*$vat)/100,2) . "</td>");
			echo("</tr>");
			echo("<tr>");
			echo("<td colspan='3' class='text-right'><b>TOTAL</b></td>");
			echo("<td class='text-right'><b>G" . number_format(((($total*$vat)/100)+$total),2) . "</b></td>");
			echo("</tr>");
			?>
			</table>
		</div>
	</body>

</html>