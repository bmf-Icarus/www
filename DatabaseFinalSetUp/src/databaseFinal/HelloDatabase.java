package databaseFinal;
import java.sql.Connection;
import java.sql.Statement;
import java.sql.DriverManager;

public class HelloDatabase {
	public static void main(String[] args) throws Exception {
		// register the driver
		String sDriverName = "org.sqlite.JDBC";
		Class.forName(sDriverName);
		Connection c = null;
		Statement stmt = null;

		try {
			c = DriverManager.getConnection("jdbc:sqlite:FootballStatsFinalEmpty.db");
			c.createStatement().execute("PRAGMA foreign_keys = ON");
			stmt = c.createStatement();
			String sql;

			sql = "CREATE TABLE Player(" 
					+ "PlayerID       INTEGER    PRIMARY KEY,"
					+ "Name		      TEXT," 
					+ "Team  		  TEXT," 
					+ "Age 	 	      INT," 
					+ "College        TEXT,"
					+ "Number         INT,"
					+ "FOREIGN KEY(Team) REFERENCES Team(TeamName));";
			stmt.executeUpdate(sql);

			sql = "CREATE TABLE QbStats(" 
					+ "QbStatsID           INT    PRIMARY KEY,"
					+ "PlayerID       INT," 
					+ "GameID         INT,"
					+ "PassAtt        INT," 
					+ "Comp           INT,"
					+ "CompPercent    INT,"
					+ "PassYds        INT," 
					+ "PassTds        INT,"
					+ "Int		      INT," 
					+ "Sacked         INT,"
					+ "Long           INT,"
					+ "FOREIGN KEY(PlayerID) REFERENCES Player(PlayerID),"
					+ "FOREIGN KEY(GameID) REFERENCES Games(GameID));";
			stmt.executeUpdate(sql);

			sql = "CREATE TABLE RbStats(" 
					+ "RbStatsID           INT    PRIMARY KEY,"
					+ "PlayerID       INT,"
					+ "GameID         INT," 
					+ "RushAtt        INT,"
					+ "RushYds        INT," 
					+ "RushTds        INT,"
					+ "Fumble         INT," 
					+ "LongRush       INT,"
					+ "FOREIGN KEY(PlayerID) REFERENCES Player(PlayerID),"
					+ "FOREIGN KEY(GameID) REFERENCES Games(GameID));";
			stmt.executeUpdate(sql);

			sql = "CREATE TABLE WrStats(" 
					+ "WrStatsID       INT    PRIMARY KEY,"
					+ "PlayerID       INT," 
					+ "GameID         INT,"
					+ "Rec            INT," 
					+ "RecYds         INT,"
					+ "RecTds         INT," 
					+ "Drops		  INT,"
					+ "Long           INT,"
					+ "FOREIGN KEY(PlayerID) REFERENCES Player(PlayerID),"
					+ "FOREIGN KEY(GameID) REFERENCES Games(GameID));";
			stmt.executeUpdate(sql);

			sql = "CREATE TABLE DefStats(" 
					+ "DefStatsID      INT    PRIMARY KEY,"
					+ "PlayerID       INT," 
					+ "GameID         INT,"
					+ "Tackles        INT,"
					+ "Sacks          INT,"
					+ "DefTds         INT,"
					+ "FOREIGN KEY(PlayerID) REFERENCES Player(PlayerID),"
					+ "FOREIGN KEY(GameID) REFERENCES Games(GameID));";
			stmt.executeUpdate(sql);

			sql = "CREATE TABLE Team("
					+ "TeamName       TEXT    PRIMARY KEY,"
					+ "City           TEXT,"
					+ "Mascot         TEXT,"
					+ "Color		  TEXT);";
			stmt.executeUpdate(sql);
			
            sql = "CREATE TABLE Games(" +
                    "GameID         INT    PRIMARY KEY," +
                    "HomeTeam       TEXT," +
                    "AwayTeam       TEXT," +
                    "AwayScore      INT," +
                    "HomeScore      INT," +
                    "Year           INT," +
                    "Month		    TEXT," +
                    "Day            INT," +
                    "FOREIGN KEY(HomeTeam) REFERENCES Team(TeamName),"
                    + "FOREIGN KEY(AwayTeam) REFERENCES Team(TeamName));";
                       stmt.executeUpdate(sql);

		} catch (Exception e) {
			System.err.println(e.getClass().getName() + ": " + e.getMessage());
		} finally {
			try {
				stmt.close();
				c.close();
			} catch (Exception e) {
				System.err.println(e.getClass().getName() + ": "
						+ e.getMessage());
			}
		}

	}

}