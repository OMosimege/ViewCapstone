<script language="javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.1.min.js">
//<script Language="JavaScript">
  <!--
    function check_empty_field()         // This is called when the submit
    {                                    // button is pressed
      if (form.username.value == "" || form.password.value == "")
      {
        alert("Please fill in the password or login field.");
        return false;                    // This doesn't submit the form
      }
      else
      {
        return true;                     // This submits the form
      }
    }

    //checks user name and password interactive
    function checkStudent(form)/*function to check userid & password*/
            {  
              window.open('studentlogin.html')/*opens the target page for next step*/
            }

    function checkLecturer(form)/*function to check userid & password*/
            {
              window.open('lecturelogin.html')/*opens the target page for next step*/
            }

    function checkStdLogin(form)/*function to check userid & password*/
            {
                /*the following code checkes whether the entered userid and password are matching*/
                if(form.userid.value == "myuserid" && form.pswrd.value == "mypswrd")
                {
                    window.open('studentlogin.html')/*opens the target page while Id & password matches*/
                }
                else
                {
                    alert("Error Password or Username")/*displays error message*/
                }
            }
            
    function checkLecLogin(form)/*function to check userid & password*/
            {
                /*the following code checkes whether the entered userid and password are matching*/
                if(form.userid.value == "myuserid" && form.pswrd.value == "mypswrd")
                {
                    window.open('lecturelogin.html')/*opens the target page while Id & password matches*/
                }
                else
                {
                    alert("Error Password or Username")/*displays error message*/
                }
            }
  -->
</script>