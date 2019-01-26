package com.test.pageObjects;

import com.test.pages.LoginPage;

public class LoginPageObject extends LoginPage{

	public void test() throws Exception
	{
		click(LoginLink);
	}
}
