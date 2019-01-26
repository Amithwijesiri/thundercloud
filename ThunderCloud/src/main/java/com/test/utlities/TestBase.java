package com.test.utlities;

import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Set;
import java.util.Map.Entry;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;
import org.json.simple.parser.JSONParser;
import org.json.simple.parser.ParseException;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.remote.DesiredCapabilities;


public class TestBase {
	
	public static WebDriver driver;
	public static long sleep = 1000;
	public static String browser;
	
	public By getLocator(String locatorValue) throws Exception
	{
		By findLocator = null;
		
		if(locatorValue.indexOf("_Id")>-1)
		{
			findLocator = By.id(locatorValue.replaceAll("_Id", "").trim());			
		}
		else if(locatorValue.indexOf("_Name")>-1 || locatorValue.indexOf("_name")>-1)
		{
			findLocator = By.name(locatorValue.replaceAll("_Name", "").replaceAll("_name", "").trim());
		}
		else if(locatorValue.indexOf("_ClassName")>-1 ||locatorValue.indexOf("_className")>-1)
		{
			findLocator = By.className(locatorValue.replaceAll("_ClassName", "").replaceAll("_className", "").trim());
		}
		else if(locatorValue.indexOf("_Link")>-1)
		{
			findLocator = By.linkText(locatorValue.replaceAll("_Link", "").trim());
		}
		else if(locatorValue.indexOf("_Css")>-1 || locatorValue.indexOf("_css")>-1)
		{
			findLocator = By.cssSelector(locatorValue.replaceAll("_Css", "").replaceAll("_css", "").trim());
		}
		else if(locatorValue.indexOf("_TagName")>-1 || locatorValue.indexOf("_tagName")>-1)
		{
			findLocator = By.tagName(locatorValue.replaceAll("_TagName", "").replaceAll("_tagName", "").trim());
		}
		else if(locatorValue.indexOf("_Xpath")>-1 || locatorValue.indexOf("_")>-1)
		{
			findLocator = By.xpath(locatorValue.replaceAll("_Xpath", "").replaceAll("_xpath", "").trim());
		}
		else
		{
			findLocator = By.xpath(locatorValue.trim());
		}				
		return findLocator;				
	}
	
	public void initializeBrowser()
	{
		browser="firefox";
		if (browser.equalsIgnoreCase("firefox")) 
		{
			ExecuteFirefoxBrowser();
		}
		
	}
	
	public String[] readPathNames(String varName,String fileName)
	{

    	String name = null;
    	JSONParser parser = new JSONParser();
		JSONArray a = null;
		String[]paths= new String[2];
		
		try {
			a = (JSONArray) parser.parse(new FileReader("C:\\wamp64\\www\\thundercloudproject\\ThunderCloud\\src\\main\\java\\com\\test\\data\\LoginPage.json"));
		} catch (FileNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (ParseException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		HashMap <String,List<String>>map = new HashMap<String,List<String>>();
		
	  for (Object o : a)
	  {
	    JSONObject person = (JSONObject) o;
	    List<String> pathList = new ArrayList<String>();
	    pathList.add((String) person.get("xpath"));
	    pathList.add((String) person.get("abxpath"));
	    pathList.add((String) person.get("type"));
	    map.put((String) person.get("name"), pathList);

	  }
	 
	  //System.out.println(Arrays.asList(map)); 
	  Set<Entry<String, List<String>>> hashSet=map.entrySet();
	  
	  for(Entry entry:hashSet ) {
	  	
		 List<String> myList = new ArrayList<>();
		 myList=(List<String>) entry.getValue();
		
		 if (entry.getKey().equals(varName)) 
		 {
			paths[0]=myList.get(0);
			paths[1]=myList.get(1);
			break;
		 }
		
	     
	 }
	
	  System.out.println(paths);
    
		//Read the xpath from param name in json
		
		return paths;
	}
	
	public String readData(String varName,String fileName)
	{
		//Read the data from param name in json
		String data=null;
		return data;
	}
	
	@SuppressWarnings("deprecation")
	public WebDriver ExecuteFirefoxBrowser()
	{
		try 
		{
			String workingDir = System.getProperty("user.dir") + "\\geckodriver.exe";
			System.setProperty("webdriver.gecko.driver", workingDir);
			System.out.print(workingDir);
			DesiredCapabilities capabilities = DesiredCapabilities.firefox();
			capabilities.setCapability("marionette", true);
			driver = new FirefoxDriver(capabilities);

			driver.manage().window().maximize();
			
			
		} catch (Exception e) {
			System.out.println("Erroe log:"+e.getMessage());
		}
		openPage();
		return driver;
		
		
	}
	
	
	public void openPage() 
	{
		String url="https://www.ebay.com/";
		driver.get(url);
	}
	
	public boolean click(String[] elements) throws Exception
	{
		boolean clickLink = true;
		try
	    {
			driver.findElement(getLocator(elements[1])).click();			
			Thread.sleep(sleep*2);
		
		}
	    catch (Exception e )
	    {
	    	try {  		
		    		driver.findElement(getLocator(elements[2])).click();			
					Thread.sleep(sleep*2);
				
				} 
	    		catch (Exception e2) 
	    		{
	    			clickLink =false;
	    		}
	    	
	    }			
		return clickLink;				
	}

}
