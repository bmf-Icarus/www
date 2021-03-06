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
			$group = "";
			
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
					$select = "Name, GameID, RushAtt";
					break;
				case "Rush Yards":
					$select = "Name, GameID, RushYds";
					break;
				case "Rush Touchdowns":
					$select = "Name, GameID, RushTds";
					break;
				case "Fumbles":
					$select = "Name, GameID, Fumble";
					break;
				case "Receptions":
					$select = "Name, GameID, Rec";
					break;
				case "Reception Yards":
					$select = "Name, GameID, RecYds";
					break;
				case "Reception Touchdowns":
					$select = "Name, GameID, RecTds";
					break;
				case "Drops":
					$select = "Name, GameID, Drops";
					break;
				case "Tackles":
					$select = "Name, GameID, Tackles";
					break;
				case "Sacks":
					$select = "Name, GameID, Sacks";
					break;
				case "Defensive Touchdowns":
					$select = "Name, GameID, DefTds";
					break;
				case "Home Team":
					$select = "GameID, HomeTeam";
					break;
				case "Away Team":
					$select = "GameID, AwayTeam";
					break;
				case "Home Score":
					$select = "GameID, HomeScore";
					break;
				case "Away Score":
					$select = "GameID, AwayScore";
					break;
					
				case "Group Touchdowns":
					$select = "PassTds, COUNT(*)";
					$group = " GROUP BY PassTds";
					break;
			}
			
			switch ( $position ) {
				case "QB":
					$from = "Player, QbStats";
					$where = " WHERE Player.PlayerID = QbStats.PlayerID";
					break;
				case "RB":
					$from = "Player, RBStats";
					$where = " WHERE Player.PlayerID = RbStats.PlayerID";
					break;
				case "WR":
					$from = "Player, WRStats";
					$where = " WHERE Player.PlayerID = WrStats.PlayerID";
					break;
				case "DB":
					$from = "Player, DefStats";
					$where = " WHERE Player.PlayerID = DefStats.PlayerID";
					break;
				case "GM":
					$from = "Games";
					break;
			}
			
			$query = "SELECT " . $select. " FROM " . $from . $where . $group;
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