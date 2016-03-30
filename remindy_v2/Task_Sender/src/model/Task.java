package model;

import java.util.GregorianCalendar;

public class Task {
	private User user;
	private GregorianCalendar date;
	private String title;
	private String desc;
	
	public Task(User user,GregorianCalendar date,String title,String desc){
		this.user =user;
		this.date = date;
		this.title = title;
		this.desc = desc;
	}

	public User getUser() {
		return user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	public GregorianCalendar getDate() {
		return date;
	}

	public void setDate(GregorianCalendar date) {
		this.date = date;
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public String getDesc() {
		return desc;
	}

	public void setDesc(String desc) {
		this.desc = desc;
	}
	
	
}
