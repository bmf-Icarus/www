<?php print( '<?xml version = "1.0" encoding = "utf-8"?>' ) ?>
<!DOCTYPE html PUBLIC "-//w3c//DTD XHTML 1.0 strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	
<!-- database.php -->
<html xmlns = "http://ww.w3.org/1999/xhtml">
	<head>
		<title>Search Results</title>
	<style type = "text/css">
		body 	{	font-family: arial, sans-serif;
					background-color: #F0E68C } 
		table 	{	background-color: #ADD8E6 }
		td 		{	padding-top: 2px;
					padding-bottom: 2px;
					padding-left: 4px;
					padding-right: 4px;
					border-width: 1px;
					border-style: inset }
	</style>
	</head>
	<body>
		<?php
			
			if(!class_exists('SQLite3'))
				die("Could not find database </body></html>" );
					
			$db = new SQLite3("DBFinalProject.db");

			extract($_POST);
			print("$position");
			print("$stats");
			
			//$query = "SELECT ".$what. "FROM ".$where;	
			$results = $db->query("SELECT * FROM Player");
			
		?>
		<h3>Search Results</h3>
		<table>
			<?php
				
				$count = 0;
				
				while ( $row = $results->fetchArray(SQLITE3_ASSOC) ){
					print( "<tr>");
					foreach ( $row as $key => $value ){
						print("<td>$value</td>" );
					}
					print( "</tr>" );
					
				}
			?>
		</table>
		<br /> Your search yielded <strong>
		<?php print( "$count" ) ?> results.<br /><br /></strong>
	</body>
</html>