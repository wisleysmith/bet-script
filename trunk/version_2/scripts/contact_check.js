function contact_validation()
{	

   var err=0;
   var message =""; 
	var count =0;

//Name_192 Psd Creative
	if(document.contact.name.value=="")
	{
		
	err++;
	message=message+"Enter Name\n";
	}
	else if(document.contact.name.value!="") 
	{  
  	FN=document.contact.name;
  	var i,index,j;
  	var str="!@#$%^&*()~`_-=*/<+\|?:{],}[;'.> 0987654321";                      
	  for (i = 0; i < FN.length; i++) 
	  {
		var c = FN.charAt(i);                 
		index=str.indexOf(c) ;                        
		if(index!=-1) 
		{
			err++;
			message=message+"Invalid Name\n";
			break;
		}
	  }           
    } 


//Email Address_192 Psd Creative
	if(document.contact.email.value=="")
	{
	err++;
	message=message+"Enter Email Address\n"; 
	}
	else if(document.contact.email.value!="") 
	{              
	 EA=document.contact.email.value; 
	EA = EA.toLowerCase();                 
 	if((EA.substring(0,1)<"a" || EA.substring(0,1)>"z") && (EA.substring(0,1)<"A" || EA.substring(0,1)>"Z"))
 	{               
 	err++;
	 message=message+"Invalid E-mail Address\n";             
 	}
	 else 
	 {              
	if(!checkemail(EA)) 
	{                   
	err++;
	message=message+"Invalid E-mail Address\n";           
	}
	}  
	} 

// Subject_192 Psd Creative
	if(document.contact.buss.value=="")
	{
	err++;
	message=message+"Enter your Business\n";
	}

//Message_192 Psd Creative
	if(document.contact.message.value=="")
	{
	err++;
	message=message+"Enter Message\n";
	}
	
	if(document.contact.name.value!="" && document.contact.email.value!="" && document.contact.buss.value!="" && document.contact.message.value!="")
	{
		//document.contact.action="contact_send.php";
		document.contact.submit()
		
	}
	
//alert part

	if(err>=1)
               {
                 var i;
                 var almsg;
                 var errmsg="";
                 almsg = new Array(err);
              for(i=0;i<err;i++)
               {
                 almsg=message.split('\n');
                 errmsg=almsg[i];
						 		   
				 if(errmsg=="Enter Name"||errmsg=="Invalid Name")
               {                
                document.contact.name.value="";
                document.contact.name.focus();   
                alert(message);
                return false; 
				}
				else if(errmsg=="Enter Email Address"||errmsg=="Invalid E-mail Address")
               {                
                document.contact.email.value="";
                document.contact.email.focus();   
                alert(message);
                return false; 
              }
			  else if(errmsg=="Enter your Business")
               {                
                document.contact.buss.value="";
                document.contact.buss.focus();   
                alert(message);
                return false; 
              }	 
			   else if(errmsg=="Enter Message")
               {                
                document.contact.message.value="";
                document.contact.message.focus();   
                alert(message);
                return false; 
              }	 
			
        		
			  
		  }
			  }
			

	
}
	
      function checkemail(str) 
      {
        var str;
		var testresults
        //var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i

        //var filter=/^[a-z][a-z|0-9|]*([_][a-z|0-9]+)*([.][a-z|0-9]+([_][a-z|0-9]+)*)?@[a-z][a-z|0-9|]*\.([a-z][a-z|0-9]*(\.[a-z][a-z|0-9]*)?)$/

        //var filter = /%u([0-9A-Za-z]{4})/g;
		
    var filter=new RegExp("^[a-zA-Z0-9_.\\-]+@[a-zA-Z0-9\\-]+\\.(co.in|com|org|net|biz|info|bussinessname|aero|biz|info|jobs|museum|CO.IN|COM|ORG|NET|BIZ|INFO|BUSSINESSNAME|AERO|BIZ|INFO|JOBS|MUSEUM)$");

        if (filter.test(str))
            testresults=true
        else 
        {
           // alert("Please input a valid email address!");
			 document.contact.email.value="";
            testresults=false
        }
        return (testresults)
          
	  }
	  
	  