package util;

import java.util.Calendar;
import java.util.GregorianCalendar;
import java.util.Scanner;

public class DateUtil {
	public static GregorianCalendar convertToGC(String date){
		//09_03_2016_10:18 PM
		Scanner sc = new Scanner(date);
		sc.useDelimiter("_");
		int day = Integer.parseInt(sc.next());
		int month = Integer.parseInt(sc.next());
		int year = Integer.parseInt(sc.next());
		String time = sc.next();
		
		GregorianCalendar c =new GregorianCalendar(year,month-1,day);

		int hour = Integer.parseInt(time.substring(0,time.indexOf(":")))+ (time.contains("PM")?12:0);
		int minute  = Integer.parseInt(time.substring(time.indexOf(":")+1,time.indexOf(" ")));
		c.set(Calendar.HOUR_OF_DAY,hour);
		c.set(Calendar.MINUTE,minute);
		sc.close();
		return c;
	}
	
	public static String convertToString(GregorianCalendar c){
		//09_03_2016_10:18 PM
		String date = "";
		date+=String.format("%02d", c.get(Calendar.DAY_OF_MONTH))+"_";
		date+=String.format("%02d", c.get(Calendar.MONTH)+1)+"_";
		date+=c.get(Calendar.YEAR)+"_";
		//
		date+=c.get(Calendar.HOUR)+":";
		date+=String.format("%02d", c.get(Calendar.MINUTE))+" ";
		date+=c.get(Calendar.HOUR_OF_DAY)<12?"AM":"PM";
		
		System.out.println(date);
		return date;
	}
}
