package controller;

import java.io.File;
import java.io.FileOutputStream;

public class FileIOController {
	public static void outputFile(String filename,String data){
		try{
			File f = new File(filename);
			FileOutputStream fos;
			if(!f.exists()){
				f.createNewFile();
				data = "Exception Log : "+data;
			}
			fos = new FileOutputStream(filename,true);
			fos.write(("\n"+data).getBytes());
			fos.close();
		}
		catch(Exception ex){
			ex.printStackTrace();
		}
	}
}
