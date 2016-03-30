package model;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

import util.DateUtil;

public class DatabaseAccessObject {
	private static Connection connection;
	
	public static ArrayList<Task> getRelevantTask(String time) throws Exception{
		if(connection==null)establishConnection();
		
		ArrayList<Task> tasks = new ArrayList<Task>();
		Statement stmt = connection.createStatement();
		
		String query = "SELECT * FROM tbl_tasks task INNER JOIN tbl_user_has_task hastask ON task.ID = hastask.TASKID "
	    		+ "INNER JOIN tbl_user user ON hastask.USERID = user.ID WHERE DATETIME_OF_REMINDER = '"+time+"'";
	    ResultSet rs = stmt.executeQuery(query);
	    System.out.println(query);
		while(rs.next()){
			String userid = rs.getString("USERID");
			String email= rs.getString("EMAIL");
			String name = rs.getString("NAME");
			String phone = rs.getString("PHONE");
			
			String date = rs.getString("DATETIME_OF_REMINDER");
			String title = rs.getString("TITLE");
			String desc = rs.getString("DESCRIPTION");
			
			User u = new User(userid,name,email,phone);
			Task t = new Task(u,DateUtil.convertToGC(date), title, desc);
			tasks.add(t);
		}
		System.out.println("Tasks length : "+tasks.size());
	    rs.close();
		return tasks;
	}
	
	
	private static void establishConnection() throws Exception{
		Class.forName("org.sqlite.JDBC");
		connection = DriverManager.getConnection("jdbc:sqlite:../database/db_remindy");
		System.out.println("Established Connection...");
	}
}
