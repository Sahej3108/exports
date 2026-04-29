<%
'if request.Form("B1")<>"" then
name=request.form("name")
email=request.form("email")
phone=request.form("phone")
subject=request.form("subject")
message=request.form("Message")


strBody3= strBody3 & "<p>MESSAGE RECEIVED TAKKAR POLYCHEM</p>"
			strBody3= strBody3 & "<table border=1 cellpadding=0 cellspacing=0 style=border-collapse: collapse bordercolor=#C0C0C0 width=52% >"
			strBody3= strBody3 & "<tr><td width=33% height=35>Name</td>"
			strBody3= strBody3 & "<td width=4% height=35>:</td><td width=63% height=35>"&name&"</td>"
			strBody3= strBody3 & "</tr><tr>"
                trBody3= strBody3 & "</tr>"
			strBody3= strBody3 & "<tr>"
			strBody3= strBody3 & "<td width=33% height=35>Email</td>"
			strBody3= strBody3 & "<td width=4% height=35>:</td>"
			strBody3= strBody3 & "<td width=63% height=35>"&email&"</td>"
			strBody3= strBody3 & "</tr>"
            strBody3= strBody3 & "<tr>"
			strBody3= strBody3 & "<td width=33% height=35>Phone</td>"
			strBody3= strBody3 & "<td width=4% height=35>:</td>"
			strBody3= strBody3 & "<td width=63% height=35>"&phone&"</td>"
	
                strBody3= strBody3 & "<td width=33% height=35>Subject</td>"
                strBody3= strBody3 & "<td width=4% height=35>:</td>"
                strBody3= strBody3 & "<td width=63% height=35>"&subject&"</td>"
                strBody3= strBody3 & "</tr>"
			strBody3= strBody3 & "<tr>"
                strBody3= strBody3 & "<td width=33% height=35>Message</td>"
                strBody3= strBody3 & "<td width=4% height=35>:</td>"
                strBody3= strBody3 & "<td width=63% height=35>"&message&"</td>"
                strBody3= strBody3 & "</tr>"
			strBody3= strBody3 & "<tr>"
			
			
			strBody3= strBody3 & "</table>"
		
            const cdoBasic=1
            schema = "http://schemas.microsoft.com/cdo/configuration/"
            Set objEmail = CreateObject("CDO.Message")
            With objEmail
            .From = "chiranjivi@substanceads.com"
            .To = "chiranjivi@substanceads.com"
            ''.To = "naresh_patel123@yahoo.com"
            .Subject = "Message Received from Takkar Polychem Website"
            .HTMLbody =  strBody3 
            '.AddAttachment "d:\Testfile.txt"
            With .Configuration.Fields
            .Item (schema & "sendusing") = 2
            .Item (schema & "smtpserver") = "mail.substanceads.com"
            .Item (schema & "smtpserverport") = 25
            .Item (schema & "smtpauthenticate") = cdoBasic
            .Item (schema & "sendusername") = "chiranjivi@substanceads.com"
            .Item (schema & "smtpaccountname") = "chiranjivi@substanceads.com"
            .Item (schema & "sendpassword") = "substance@b29"
            End With
            .Configuration.Fields.Update
            .Send
            End With
    
        strFlag=1
        
        response.redirect("thankyou.php")
    
    
    
    'end if
    %>