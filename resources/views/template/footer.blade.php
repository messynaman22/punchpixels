<section class="strapline">
    <div class="container">
        Credit Report Repair Questions? <span>Chat with a Certified FICO Expert Now: 1-877-782-7839</span>
    </div>
</section>



<footer>
        <div class="container">
            <div class="row footer2">
                <div class="col-sm-2 text-center">
                    <img src="{{ asset('/images/fico-signup.jpg') }}" class="img-responsive ficoimg">
                </div>
                <div class="col-sm-8">
                    <p>Credit1Solutions.com ™ abides by all laws/provisions of the CROA: SEC. 402(a) CREDIT REPAIR ORGANIZATIONS ACT.
                        Title IV of the Consumer Credit Protection Act (Public Law 90-321, 82 Stat. 164). Credit1Solutions.com ™does not charge
                        Advanced Fees to its clients. Credit1Solutions.com ™ is federally registered, state licensed and bonded.</p>
                    <div class="clearfix"></div>
                    <hr>
                    <p class="small">2006-2015 Credit1Solutions.com ™, All Right Reserved.<br>
                        Location: 5284 N Dixie Hwy Elizabethtown, KY 42701 Local: 279-982-4747 Toll: 877-782-7839</p>
                    <div class="banner-certified">
                        <div class="bottom_icons col-sm-4 ficoimg">                           
                             <img  class="img-responsive" src="{{ asset('/images/bottom_icon1.png') }}">
                        </div>
                       
                        <div class="bottom_icons col-sm-4 ficoimg">                           
                                <img  class="img-responsive" src="{{ asset('/images/bottom_icon2.png') }}">
                          </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <h2>How it works</h2>
                    <ul>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms Of Use</a></li>
                        <li><a href="#">Email Preferences</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tooltip-viewport.js') }}"></script>
<script>
var show_close_alert = true;
 var prevPage = {!! $result["step1"] !!};
 var startDate = {!! $result["json_startdate"] !!};

 $(".packageService").each(function(){
  $(this).html(startDate[retByName("packagedate").val()]);
 });

retByName("packagedate").change(function(){
 $(".packageService").each(function(){
  $(this).html(startDate[retByName("packagedate").val()]);
 });
});

    $("#label").click(function(){
        if($("#input").hasClass('focus')){
            $("#input").removeClass("focus");
        }
        else
        {
            $("#input").addClass("focus");
        }
    });
    $(document).click(function(){
        $('.tooltip-show').fadeOut();
    });
    $('.fa-question-circle').click(function(evt){
        evt.stopPropagation();
        var offset = $(this).offset();
        console.log($(this).next('div'));
        if($(this).closest('div').attr('class')!="row")
        {
            $(this).next('div').css({"left": offset.left-$(this).closest('div').offset().left+30+"px", "top": -35+"px", 'width':'100%'});
            $('.tooltip-show').fadeOut();
            $(this).next('.tooltip-show').fadeIn();
        }
        else
        {
            $(this).next('div').css({"left": offset.left+30+"px", "top": offset.top-35+"px"});
            $('.tooltip-show').fadeOut();
            $(this).next('.tooltip-show').fadeIn();
        }
    })
    $(".table-bordered > tbody > tr > td:nth-last-child(1)").each(function(){
           classFunc(true,"selected-package",$(this));
       });
    
    function initPackage(){
        $(".cs-check-invert").hide();
        $(".fss-check-price").hide();
        $(".cs-check-price").first().css("background-color","#FFEFE8");
        $(".fss-check-invert").first().css("background-color","#FFEFE8");
        $(".table-bordered > tbody > tr > td:nth-last-child(1)").each(function(){
            classFunc(false,"selected-package",$(this));
        });
         $(".table-bordered > tbody > tr > td:nth-last-child(2)").each(function(){
            classFunc(true,"selected-package",$(this));
        });
        $("#fss").parent("th").css("background-color","#D2D2D2");
        $("#cs").parent("th").css("background-color","#D3C7C1");
        $(".cs > span").each(function(){
            var $this = $(this);
            classFunc(true,"dark",$this);
        });

          
        $(".fss > span").each(function(){
              var $this = $(this);
            classFunc(false,"dark",$this);
        });
        $("#package_tooltip").html(comprehensive);
    }

    $("#cs").click(function(){
        retByName("package").val("Comprehensive");
        $(".cs > span").each(function(){
            var $this = $(this);
            classFunc(true,"dark",$this);
        });
        $("#package_tooltip").html(comprehensive);
          
        $(".fss > span").each(function(){

              var $this = $(this);
            classFunc(false,"dark",$this);
        });
        $(".table-bordered > tbody > tr > td:nth-last-child(1)").each(function(){
            classFunc(false,"selected-package",$(this));
        });
         $(".table-bordered > tbody > tr > td:nth-last-child(2)").each(function(){
            classFunc(true,"selected-package",$(this));
        });
         $(".cs-check-price").first().css("background-color","#FFEFE8");
         $(".fss-check-invert").first().css("background-color","#FFEFE8");
         $("#fss").parent("th").css("background-color","#D2D2D2");
         $("#cs").parent("th").css("background-color","#D3C7C1");
        $("#fss_price").html("$89.95");
        $("#price_label").html("Comprehensive Service");
        $(".fss-check-price").hide();
        $(".fss-check-invert").show();
        $(".cs-check-invert").hide();
        $(".cs-check-price").show();
    });

     $("#fss").click(function(){
        retByName("package").val("FreshStart");
      $("#package_tooltip").html(fresh);
       $(".cs > span").each(function(){
           var $this = $(this);
            classFunc(false,"dark",$this);            
       });
    $(".table-bordered > tbody > tr > td:nth-last-child(2)").each(function(){
           classFunc(false,"selected-package",$(this));
       });
    $(".table-bordered > tbody > tr > td:nth-last-child(1)").each(function(){
           classFunc(true,"selected-package",$(this));
       });

    $("#cs").parent("th").css("background-color","#D2D2D2");
    $("#fss").parent("th").css("background-color","#D3C7C1");
    $(".fss-check-price").first().css("background-color","#FFEFE8");
    $(".cs-check-invert").first().css("background-color","#FFEFE8");
       $(".fss > span").each(function(){
             var $this = $(this);
            classFunc(true,"dark",$this);
       });
        $("#fss_price").html("$79.95");
        $("#price_label").html("Fresh Start Service");
        $(".cs-check-invert").show();
        $(".cs-check-price").hide();
        $(".fss-check-invert").hide();
        $(".fss-check-price").show();
    });
    
    

     function classFunc(isAdd,className,object){
        if(isAdd){
            if(!object.hasClass(className))
                    object.addClass(className);
            }else{
                if(object.hasClass(className))
                    object.removeClass(className);
            }
     }
     function startAudio(){
                play = true;
                audio.trigger('play');
                $("#playAudio").html("Audio playing...");
    }
     
    function pauseAudio(){
                play = false;
                audio.trigger('pause');
                $("#playAudio").html("Click for audio");
        }
    function toogleAudio(){
        if(!play){
            startAudio();
        }else{
            pauseAudio();
        }
    }
    
     $(document).ready(function(){
        audio = $("#step2audio");
        play = false;
        setTimeout(function(){
            if(!play)
                startAudio();
        },3000);
     });
     $("#reqAlert").hide();
     function sendFormRequest(){
        var valid = true;
        errorMsg = "";
        $(".req").each(function(){
            $this = $(this);

            if($this.val()==""){
                valid = false;
                var name = $this.attr("name");
                classFunc(true,"input-error",$this);
                assignErrorGroup(name);
            }else{
                  classFunc(false,"input-error",$this);
            }
        });

        if(!valid)
            errorMsg += "Please fill all fields.<br>";

        if(retByName("cvv").val().length != 3 || isNaN(retByName("cvv").val())){
            classFunc(true,"input-error",retByName("cvv"));
            retByName("cvv").val("");
            errorMsg+="CVV should be 3 digit number<br>";
            valid = false;
        }else{
              if(retByName("cvv").val()!="")
             classFunc(false,"input-error",retByName("cvv"));
        }

        if(retByName("month").val()=="EXP Month"){
            classFunc(true,"input-error",retByName("month"));
            errorMsg+="Please enter a date.<br>";
            valid = false;
        }else{
             classFunc(false,"input-error",retByName("month"));
        }   
        if(retByName("year").val()=="EXP-year"){
            classFunc(true,"input-error",retByName("year"));
            errorMsg+="Please enter a year.<br>";
            valid = false;
        }else{
            classFunc(false,"input-error",retByName("year"));
        }

        if(retByName("packagedate").val()=="default"){
          classFunc(true,"input-error",retByName("packagedate"));
          errorMsg+="Please select a date for your first payment.<br>";
          valid = false;
        }else{
            classFunc(false,"input-error",retByName("packagedate"));
        }

        if(retByName("routing_number").val().length!=9||isNaN(retByName("routing_number").val())){
            classFunc(true,"input-error",retByName("routing_number"));
            errorMsg+="Routing number should be a 9 digit number<br>";
            valid = false;
        }else{
            if(retByName("routing_number").val()!="")
              classFunc(false,"input-error",retByName("routing_number"));
        }

        if(isNaN(retByName("account_number").val())){
            classFunc(true,"input-error",retByName("account_number"));
            errorMsg+="Account number should be  number<br>";
            valid = false;
        }else{
            if(retByName("account_number").val()!="")
              classFunc(false,"input-error",retByName("account_number"));
        }


        if(!checkForCardNumber(retByName("card_number").val())){
            classFunc(true,"input-error",retByName("card_number"));
            errorMsg+="Card number should start with 4 or 5 and should have 16 digits with '-' between every 4 digits.<br>e.g (5423-5897-8978-1234)<br>";
            valid = false;
        }


        if(valid){
            if(retByName("card_number").val().charAt(0)==4){
                retByName("card_type").val("Visa");
            }else{
                retByName("card_type").val("Master Card");
            }
            show_close_alert = false;
            document.getElementById("step2form").submit();
        }else{
            checkForValidGroups();
            $("#reqMessage").html(errorMsg);
            $("#reqAlert").show();
        }

     
     }

     function assignErrorGroup(name){
        if(name=="full_name"||name=="street_address"||name=="primary_zip_code"){
            classFunc(true,"field_error",$("#primary_bill"));
        }else if(name=="bank_name"||name=="routing_number"||name=="account_number"){
            classFunc(true,"field_error",$("#sec_pay"));
        }else if(name=="card_number"||name=="month"||name=="year"||name=="cvv"){
            classFunc(true,"field_error",$("#primary_pay"));
        }else  if(name=="contact_information"||name=="billing_address"||name=="secondary_zip_code"){
            classFunc(true,"field_error",$("#sec_bill"));
        }
     }

     function hideAlert(){
        $("#reqAlert").hide();
     }


     function checkForCardNumber(value){
        var regex = /^[4|5][0-9]{3}-[0-9]{4}-[0-9]{4}-[0-9]{4}$/;
        return (regex.test(value)||value=="");
     }

     function checkForValidGroups(){
        if(!checkHasError("full_name")&&!checkHasError("street_address")&&!checkHasError("primary_zip_code")){
            classFunc(false,"field_error",$("#primary_bill"));
        }
        if(!checkHasError("bank_name")&&!checkHasError("routing_number")&&!checkHasError("account_number")){
            classFunc(false,"field_error",$("#sec_pay"));
        }

        if(!checkHasError("card_number")&&!checkHasError("month")&&!checkHasError("year")&&!checkHasError("cvv")){
            classFunc(false,"field_error",$("#primary_pay"));
        }

         if(!checkHasError("contact_information")&&!checkHasError("billing_address")&&!checkHasError("secondary_zip_code")){
            classFunc(false,"field_error",$("#sec_bill"));
        }
     }

     function checkHasError(name){
        return retByName(name).hasClass("input-error");
     }
     setPrimaryInfo();
     setSecondaryInfo();
     $("#saci").click(function(){
        if(this.checked){
           setPrimaryInfo();
        }else{
            unsetPrimaryInfo();
        }
     });

     $("#sacib").click(function(){
        if(this.checked){
            setSecondaryInfo();
        }else{
            unsetSecInfo();
        }
     });

     function setSecondaryInfo(){
        retByName("contact_information").val( prevPage.fname+" "+prevPage.mname+" "+prevPage.lname);
        retByName("billing_address").val(prevPage.paddress);
        retByName("secondary_zip_code").val(prevPage.zip);
     }

     function unsetSecInfo(){
        retByName("contact_information").val("");
        retByName("billing_address").val("");
        retByName("secondary_zip_code").val("");
     }

     function setPrimaryInfo(){
        retByName("full_name").val( prevPage.fname+" "+prevPage.mname+" "+prevPage.lname);
        retByName("street_address").val(prevPage.paddress);
        retByName("primary_zip_code").val(prevPage.zip);
     }

     function unsetPrimaryInfo(){
        retByName("full_name").val("");
        retByName("street_address").val("");
        retByName("primary_zip_code").val("");
     }

     function retByName(name){
        return $($("[name="+name+"]").get(0));
     }

     retByName("cvv").bind("change paste keyup",function(){
        var $this = $(this);
        var length = $this.val().length;
        var ch = $this.val().charAt(length-1);
        var currentValue = $this.val();

        if(isNaN(ch)||length>3){
          $this.val(currentValue.substring(0,length-1));
          return;
        }
     });

     retByName("routing_number").bind("change paste keyup",function(){
        var $this = $(this);
        var length = $this.val().length;
        var ch = $this.val().charAt(length-1);
        var currentValue = $this.val();

            if(isNaN(ch)||length>9){
              $this.val(currentValue.substring(0,length-1));
              return;
            }

        });

     retByName("account_number").bind("change paste keyup",function(){
        var $this = $(this);
        var length = $this.val().length;
        var ch = $this.val().charAt(length-1);
        var currentValue = $this.val();

            if(isNaN(ch)){
              $this.val(currentValue.substring(0,length-1));
              return;
            }

        });

      retByName("card_number").bind("change paste keyup",function(){           
           var $this = $(this);
           var length = $this.val().length;
           var ch = $this.val().charAt(length-1);
           var currentValue =$this.val();

           if(length>=1 && !(currentValue.charAt(0)==4||currentValue.charAt(0)==5)){
              $this.val("");
              return;
           }

           if(isNaN(ch)||length>19){
             $this.val(currentValue.substring(0,length-1));
             return;
           }

           for(var i=4;i<length;i+=5){              
              if(length>i  &&  currentValue.charAt(i)!="-"){             
               $this.val(splitString(i,currentValue));
               length++;
              } 
           }

      });

      function splitString(at,currentValue){
        var num1 = currentValue.substring(0,at);
        var num2 = currentValue.substring(at,currentValue.length);
        return num1+"-"+num2;
      }
    
       $(".zipcode").each(function(){
            $(this).bind("change paste keyup",function(event){

                    if(checkForKey(event))
                      return;

                    var $this = $(this);
                    var length = $this.val().length;
                    var ch = $this.val().charAt(length-1);
                    var currentValue =$this.val();                   

                    if(isNaN(ch)||length>5){
                      $this.val(currentValue.substring(0,length-1));
                      return;
                    }

                    if(length==5){                  
                      sendZipCode(currentValue,$this);                  
                    }                
          });
       });

      function checkForKey(e){
          if ((e.which < 65 || e.which > 122) && (e.which < 48 || e.which > 57))
           {
               return true;
           }
           return false;
      }

       function sendZipCode(code,zipObj){          
          zip = zipObj.attr("name");                               
          $.ajax({url: "http://api.zippopotam.us/us/"+code, 
                         success: function(result){       
                                hideAlert();
                                classFunc(false,"input-error",zipObj);                                
                            },
                            error: function(xhr,status,error){                                
                                classFunc(true,"input-error",zipObj);                                
                                $("#reqAlert").show();
                                $("#reqMessage").html("Please enter valid zipcode.");
                            }        
                    });
       }  

       $(".alpha").bind("change paste keyup",function(event){
              $this = $(this);
              var $this = $(this);
              var length = $this.val().length;
              var ch = $this.val().charAt(0);
              var currentValue =$this.val();

              if(!isNaN(currentValue)){
                $this.val("");
                return;
              }

              if(length>=1){
                var sub = currentValue.substring(1,length);
                $this.val(ch.toUpperCase()+sub);
                return;
              }


       });


      

           

       $(window).bind("beforeunload", function() {
           if (show_close_alert) {
               return "You are about to leave this page.";
           }
       });

      function printDiv(data) 
          {
              var mywindow = window.open('', 'my div', 'height=600,width=800');
              mywindow.document.write('<html><head><title>my div</title>');
              /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
              mywindow.document.write('</head><body >');
              mywindow.document.write(data);
              mywindow.document.write('</body></html>');

              mywindow.document.close(); // necessary for IE >= 10
              mywindow.focus(); // necessary for IE >= 10

              mywindow.print();
              mywindow.close();

              return true;
          }


     var fresh = " <p><a class='printlink'>Print&nbsp;<i class='fa fa-print'></a></i></p><p>1. Unlimited Credit Bureau Disputes<br>&nbsp;&nbsp;a. Equifax, Experian and/or TransUnion<br>2. Credit Advisor to help you towards better credit worthiness<br>3. Access to our 24/7 Online Portal<br>&nbsp;&nbsp;a. Ability to Track Results<br>&nbsp;&nbsp;b. Check Status of Accounts<br>&nbsp;&nbsp;c. Communicate and ask questions with a Credit1Solutions.com Credit Advisor<br>&nbsp;&nbsp;d. Download, Scan and Upload documents with ease in our attachment section<br>4. In-depth Budget Expenditure Spreadsheet<br>5. Online Educational Librarya. Information ranging from but not limited to<br>&nbsp;&nbsp;i. Information about Credit Reports and Credit Scores<br>&nbsp;&nbsp;ii. General Credit Reporting Information<br>&nbsp;&nbsp;iii. State and Federal Laws<br>&nbsp;&nbsp;iv. State and Federal Rights<br>&nbsp;&nbsp;v. …and more.</p>";
     var comprehensive = "<p><a class='printlink'>Print&nbsp;<i class='fa fa-print'></a></i></p><p>1. Unlimited Credit Bureau Disputes<br>&nbsp;&nbsp;a. Equifax, Experian and/or TransUnion<br>2. Unlimited Personal Summary Information Disputes.<br>&nbsp;&nbsp;a. Challange questionable negative addresses, employment history, names, social security <br>3. Unlimited Inquiry Investigation.<br>4. Credit Advisor to help you towards better credit worthiness<br>&nbsp;&nbsp;5. Access to our 24/7 Online Portal numbers and more.<br>&nbsp;&nbsp;a. Ability to Track Results.<br>&nbsp;&nbsp;b. Check Status of Accounts<br>&nbsp;&nbsp;c. Communicate and ask questions with a Credit1Solutions.com Credit Advisor.<br>&nbsp;&nbsp;d. Download, Scan and Upload documents with ease in our attachment section<br>6. In-depth Budget Expenditure Spreadsheet<br>7. Online Educational Library<br>&nbsp;&nbsp;a. Information ranging from but not limited to<br>&nbsp;&nbsp;i. Information about Credit Reports and Credit Scores<br>&nbsp;&nbsp;ii. General Credit Reporting Information<br>&nbsp;&nbsp;iii. State and Federal Laws<br>&nbsp;&nbsp;iv. State and Federal Rights<br>&nbsp;&nbsp;v. …and more.</p>";
     initPackage();

     $(".printlink").click(function(){
           $this = $(this);
           elem = $this.parent().next();
           printDiv(elem.html());
     });
</script>


</body>
</html>
