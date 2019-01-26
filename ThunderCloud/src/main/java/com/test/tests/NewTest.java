package com.test.tests;

import org.testng.annotations.BeforeClass;
import org.testng.annotations.Test;

import com.test.pageObjects.LoginPageObject;
import com.test.utlities.TestBase;

public class NewTest extends TestBase{
 
	
	LoginPageObject Login = new LoginPageObject();
	 @BeforeClass
	  public void startUp()
	  {
		  initializeBrowser();
	  }
		
	  @Test(description="Test Home Page Title")
	  public void testHomePageTitle() throws Exception 
	  {
		  Login.test();
	  }
}
