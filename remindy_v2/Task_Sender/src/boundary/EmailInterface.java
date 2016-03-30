package boundary;

import java.util.Properties;

import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.AddressException;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeMessage;

public class EmailInterface {
	private static final String EMAIL_ID = "RemindyGoalThinker@gmail.com";
	private static final String EMAIL_PASS = "goalthinker";
	private static Session session;
	
	public static void activateSession(){
	      Properties props = new Properties();  
	      props.put("mail.smtp.host", "smtp.gmail.com");  
	      props.put("mail.smtp.socketFactory.port", "465");  
	      props.put("mail.smtp.socketFactory.class",  
	                "javax.net.ssl.SSLSocketFactory");  
	      props.put("mail.smtp.auth", "true");  
	      props.put("mail.smtp.port", "465");  
	      
	      session = Session.getDefaultInstance(props,  
	    		   new javax.mail.Authenticator() {  
	    		   protected PasswordAuthentication getPasswordAuthentication() {  
	    		   return new PasswordAuthentication(EMAIL_ID,EMAIL_PASS);  
	    		   }  
	    		  });  
	}
	
	public static String sendEmail(String to,String title,String desc) throws AddressException, MessagingException{
	     
	     //compose the message  
         MimeMessage message = new MimeMessage(session);  
         message.setFrom(new InternetAddress(EMAIL_ID));  
         message.addRecipient(Message.RecipientType.TO,new InternetAddress(to));  
         message.setSubject(title);  
         message.setText(desc);  
  
         // Send message  
         Transport.send(message);
         System.out.println("Email Title : ["+title+"] has sent to "+to+" successfully");
         return "Email To : "+to+"\n";
	  
	}
}
