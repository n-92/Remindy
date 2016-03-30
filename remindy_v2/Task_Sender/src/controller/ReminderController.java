package controller;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.GregorianCalendar;

import boundary.EmailInterface;
import boundary.SmsInterface;
import model.DatabaseAccessObject;
import model.Task;
import model.User;
import util.DateUtil;

public class ReminderController {

	public static void performReminder(){
		GregorianCalendar d = new GregorianCalendar();
		try{
			ArrayList<Task> tasks = getRelevantTask();
			if(tasks.isEmpty())return;
			EmailInterface.activateSession();
			String log = "";
			for(Task task:tasks){
				String message = "Task Reminder : "+task.getTitle()+"\nHi "+task.getUser().getName()+",\nReminder from Remindy : "+task.getDesc();
				log+=EmailInterface.sendEmail(task.getUser().getEmail(), task.getTitle(),message);
				log+=SmsInterface.sendMessage(task.getUser().getNumber(), message);
				//Update Task Reminder
			}
			String filename =
					"LOG_"+d.get(Calendar.YEAR)+"_"+d.get(Calendar.MONTH)+"_"+d.get(Calendar.DATE)
					+"_"+d.get(Calendar.HOUR_OF_DAY)+"_"+d.get(Calendar.MINUTE)+".txt";
					;
			FileIOController.outputFile(filename, log);

		}
		catch(Exception ex){
			String filename =
					"ERROR_"+d.get(Calendar.YEAR)+"_"+d.get(Calendar.MONTH)+"_"+d.get(Calendar.DATE)
					+"_"+d.get(Calendar.HOUR_OF_DAY)+"_"+d.get(Calendar.MINUTE)+".txt";
					;
			FileIOController.outputFile(filename, ex.getClass()+"\n"+ex.getMessage()+"\n"+ex.getCause());
			ex.printStackTrace();
		}
	}


	private static ArrayList<Task> getRelevantTask() throws Exception{
		ArrayList<Task> tasks = new ArrayList<Task>();

		//perform retrieve from DB
		GregorianCalendar c = new GregorianCalendar();
		System.out.print("Current Time : ");
		DateUtil.convertToString(c);


		c.add(Calendar.MINUTE, 5);
		System.out.print("5 MINUTE EARLIER : ");
		tasks.addAll(DatabaseAccessObject.getRelevantTask(DateUtil.convertToString(c)));//getRelevantTask();
		
		c.add(Calendar.MINUTE, 25);
		System.out.print("30 MINUTE LATER : ");
		tasks.addAll(DatabaseAccessObject.getRelevantTask(DateUtil.convertToString(c)));//get 30
//		
		

		//dummy data
//		User u = new User("junhao","Tang Jun Hao","junhao0913@hotmail.com","+6591333107");
//		Task t = new Task(u,null,"Dummy Task","Lets start working!");
//		tasks.add(t);

		return tasks;
	}
}
