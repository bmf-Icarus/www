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
			
			$where = "";
			
			switch ( $stats ) {
				case "All Stats":
					$select = "*";
					break;
				case "Pass Yards":
					$select = "Name, GameID, PassYds";
					break;
				case "Pass Touchdowns":
					$select = "Name, GameID, PassTds";
					break;
				case "Interceptions":
					$select = "Name, GameID, Int";
					break;
				case "Completion Percentage":
					$select = "Name, GameID, CompPercent";
					break;
				case "Rush Attempts":
					$select = "RushAtt";
					break;
				case "Rush Yards":
					$select = "RushYds";
					break;
				case "Rush Touchdowns":
					$select = "RushTds";
					break;
				case "Fumbles":
					$select = "Fumble";
					break;
				case "Receptions":
					$select = "Rec";
					break;
				case "Reception Yards":
					$select = "RecYds";
					break;
				case "Reception Touchdowns":
					$select = "RecTds";
					break;
				case "Drops":
					$select = "Drops";
					break;
				case "Tackles":
					$select = "Tackles";
					break;
				case "Sacks":
					$select = "Sacks";
					break;
				case "Defensive Touchdowns":
					$select = "DefTds";
					break;
			}
			
			switch ( $position ) {
				case "QB":
					$from = "Player, QBStats";
					$where = " WHERE Player.PlayerID = QBStats.PlayerID";
					break;
				case "RB":
					$from = "Player, RBStats";
					break;
				case "WR":
					$from = "Player, WRStats";
					break;
				case "DB":
					$from = "Player, DefStats";
					break;
			}
			
			$query = "SELECT " . $select. " FROM " . $from . $where;
			$results = $db->query($query);
			$cols = $results->numColumns(); 
			
		?>
		<h3>Search Results</h3>
		<table>
			<?php
				
				$count = 0;
				
				print( "<tr>");
				for ($i = 0; $i < $cols; $i++) {
					$colName = $results->columnName($i);				
						print("<td>$colName</td>" );
				}
				print( "</tr>" );
				
				while ( $row = $results->fetchArray(SQLITE3_ASSOC) ){
									
					print( "<tr>");
					
					foreach ( $row as $key => $value ){
						print("<td>$value</td>" );
					}
					print( "</tr>" );
					$count++;
				}

			?>
		</table>
		<br /> Your search yielded <strong>
		<?php print( "$count" ) ?> results.<br /><br /></strong>
	</body>
</html>