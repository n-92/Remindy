package boundary;

import java.util.Timer;
import java.util.TimerTask;

import controller.ReminderController;

public class Main {
	public static final int MINUTE = 60*1000;
	public static String accountTo = "";
	
	public static void main(String args[]){
		//Debug Purpose
		//System.out.print("Enter an email address for debugging : ");
		//Scanner sc = new Scanner(System.in);
		//accountTo = sc.nextLine();
		//sc.close();
		
		TimerTask timertask = new TimerTask(){
			@Override
			public void run() {
				// TODO Auto-generated method stub
				Thread thread = new Thread(){
					public void run(){
						System.out.println("Processing..");
						ReminderController.performReminder();
						try {
							System.out.println("Done!");
							this.finalize();
						} catch (Throwable e) {
							e.printStackTrace();
						}
					}
				};
				thread.start();
			}
		};
		Timer t = new Timer();
		t.scheduleAtFixedRate(timertask,0,MINUTE);
		System.out.println("Waiting...");
	}
}
