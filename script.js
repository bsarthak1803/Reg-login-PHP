$('document').ready(function(){
  //var username_state = false;
  var email_state = false;
  $('#em').on('blur', function(){
    var email = $('#em').val();
    if (email == '') {
      email_state = false;
      return;
    }
    //db verification of email
    $.ajax({
      url: 'index.php',
      type: 'post',
      data: {
        'email_check' : 1,
        'email' : email,

      },
      success: function(response){
        //alert(response); //second
        if (response == 'taken' ) {
          email_state = false;
          $('#em').parent().removeClass();
          $('#em').parent().addClass("form_error");
          $('#em').siblings("span").text('Email already taken');
        }else if (response == 'not_taken') {
          email_state = true;
          $('#em').parent().removeClass();
          $('#em').parent().addClass("form_success");
          $('#em').siblings("span").text('Email available');
        }

      }
    });
  });

  $('#fid').on('submit', function(e){
    //preserve the patterns/defaults used in input form
    e.preventDefault();
    var firstname=$('#fnm').val();
    var lastname=$('#lnm').val();
    var address=$('#addr').val();
    var phone=$('#ph').val();
    var dob=$('#birth').val();
    var email = $('#em').val();
    var password = $('#pwd').val();

    var myDate = new Date(dob);
    var today = new Date();

    // alert(firstname); //third after register
    if (email_state == false || today<myDate) {
      $('#error_msg').text('Fix the errors in the form first');
    }else{
      // proceed with form submission
      $.ajax({
        url: 'index.php',
        type: 'post',
        data: {
          'save' : 1,
          'fname' : firstname,
          'lname' : lastname,
          'add' : address,
          'phnum' : phone,
          'dob' : dob,
          'email' : email,
          'pswd' : password,
          //alert(lastname);
        },
        success: function(response){
          alert('Associate registered with Id-'+response);
          window.location="index.php";
          //  $('#em').val('');
          //  alert(email);
        }
      });
    }
  });
});
