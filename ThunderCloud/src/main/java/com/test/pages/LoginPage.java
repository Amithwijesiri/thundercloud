package com.test.pages;
      
      import com.test.utlities.TestBase;
      
      /**
       * @author awijesiri
       *
       */
      public class LoginPage extends TestBase
      
      {
      
        String fileNameParameters="LoginPage.json";
        String fileNameData="LoginPageData.json";
        //Reading Xpaths
        protected String[]LoginLink= readPathNames("LoginLink",fileNameParameters);
		protected String[]UserName= readPathNames("UserName",fileNameParameters);
		protected String[]Password= readPathNames("Password",fileNameParameters);
		protected String[]loginSubmit= readPathNames("loginSubmit",fileNameParameters);

        
        //Reading Data
        protected String LoginPageTitleData= readData("LoginPageTitle",fileNameData);
        protected String MyAccountPageTitleData= readData("MyAccountPageTitle",fileNameData);

        
      }
      