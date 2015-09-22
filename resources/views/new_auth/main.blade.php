<!DOCTYPE html>
<html lang="en">
  <head>
    @include('new_auth.head')
    @yield('styles')
  </head>
  <body role="document">

    @section('navbar')
        @include('new_auth.navbar')
    @show


    @yield('main')

    @section('footer')
        @include('new_auth.footer')
    @show
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="  {!! asset('js/bootstrap-formhelper.js') !!}"></script>
    <!--script src="/common/js/tooltip-viewport.js"></script-->
    <!-- Placed at the end of the document so the pages load faster -->
    @yield('scripts')

    <!-- This is only necessary if you do Flash::overlay('...') -->
    <script>
    $('#flash-overlay-modal').modal();

    $("#label").click(function(){
        if($("#input").hasClass('focus')){
            $("#input").removeClass("focus");
        }
        else {
            $("#input").addClass("focus");
        }
    });

    var show_close_alert = true;
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
        audio = $("#step1audio");
        play = false;
        setTimeout(function(){
            if(!play)
                startAudio();
        },3000);
     });

     function validateEmail(email) {
         var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
         return re.test(email);
     }

     $("#sameadd").click(function(){
            if(this.checked){

                $("#mpaddress").val($("#paddress").val());
                $("#mcity").val($("#city").val());
                $("#mstate").val($("#state").val());
                $("#mzip").val($("#zip").val());
            }else{
                $("#mpaddress").val("");
                $("#mcity").val("");
                $("#mstate").val("");
                $("#mzip").val("");
            }
     });
     
     function sendFormRequest(){
        var valid = true;
        var errorMsg = "";
        $(".req").each(function(){
            $this = $(this);
            if($this.val()==""){
                valid = false;
                classFunc(true,"input-error",$this);
                classFunc(true,"field_error",$this.prev());
            }else{
                  classFunc(false,"input-error",$this);
                 
                  classFunc(false,"field_error",$this.prev());
            }

        });
        $(".dd").each(function(){
                $this = $(this);
                console.log($this.val());
                if($this.val()=="default"){
                    valid = false;
                    classFunc(true,"input-error",$this);
                    classFunc(true,"field_error",$this.prev());
                }else{
                      classFunc(false,"input-error",$this);
                     
                      classFunc(false,"field_error",$this.prev());
                }
        });
        if(!valid){
            errorMsg +="The * marked field are required.<br>";
        }
        if(!validateEmail($("#email").val())&&($("#email").val()!="")){
          valid = false;
          classFunc(true,"input-error",$("#email"));
          classFunc(true,"field_error",$("#email").prev());
          errorMsg +="Please enter valid email address<br>"; 
        }else if($("#email").val()!=""){
            classFunc(false,"input-error",$("#email"));
            classFunc(false,"field_error",$("#email").prev());
        }
        phoneValid = true;
        $(".phone").each(function(){
            $this = $(this);
            if(!checkMobileNumber($this.val())){
              valid = false;
              phoneValid = false;
              classFunc(true,"input-error",$this);
              classFunc(true,"field_error",$this.prev());
            }else{
              classFunc(false,"input-error",$this);              
              classFunc(false,"field_error",$this.prev());
            }
        });

        if(!phoneValid){
          errorMsg +="Please enter phone number in following format 123-123-1234";
        }


        if(valid){
            show_close_alert = false;
           document.getElementById("step1form").submit();
        }else{
            $("#reqAlert").show();
            $("#errorMsg").html(errorMsg);
        }
     }

     function checkMobileNumber(number){
        var regex = /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/;
        return (regex.test(number)||number=='');
     }
     function hideAlert(){
        $("#reqAlert").hide();
     }

    function classFunc(isAdd,className,object){
       if(isAdd){
           if(!object.hasClass(className))
                   object.addClass(className);
           }else{
               if(object.hasClass(className))
                   object.removeClass(className);
           }
    }     

    function retByName(name){
       return $($("[name="+name+"]").get(0));
    }

   $(".phone").each(function(){
      $(this).bind("change paste keyup",function(){
        
        var $this = $(this);
        var length = $this.val().length;
        var ch = $this.val().charAt(length-1);
        var currentValue =$this.val();


        if(isNaN(ch)||length>12){
          $this.val(currentValue.substring(0,length-1));
          return;
        }

        if(length>3  &&  currentValue.charAt(3)!="-"){
          var num1 = currentValue.substring(0,3);
          var num2 = currentValue.substring(3,length);
          $this.val(num1+"-"+num2);
          length++;
        }

        if(length>7 &&  currentValue.charAt(7)!="-"){
          var num1 = currentValue.substring(0,7);
          var num2 = currentValue.substring(7,length);
          $this.val(num1+"-"+num2);
          return;
        }

      });
  });

   $(".zipcode").bind("change paste keyup",function(event){

                if(checkForKey(event))
                  return;

                var $this = $(this);
                var length = $this.val().length;
                var ch = $this.val().charAt(length-1);
                var currentValue =$this.val();
                if($this.val()==""){
                    zip = $this.attr("name");
                    if(zip=="zip"){
                      retByName("city").val("");
                      retByName("state").val("default");
                    }else{
                     retByName("mcity").val("");
                     retByName("mstate").val("default");
                    }
                    return;  
                }
                

                if(isNaN(ch)||length>5){
                  $this.val(currentValue.substring(0,length-1));
                  return;
                }

                if(length==5){                  
                  sendZipCode(currentValue,$this);                  
                }                
      });
   

  function checkForKey(e){
      if ((e.which < 65 || e.which > 122) && (e.which < 48 || e.which > 57))
       {
           return true;
       }
       return false;
  }

   function sendZipCode(code,zipObj){
      console.log("this is called",zipObj.attr("name"));
      zip = zipObj.attr("name");                               
      $.ajax({url: "http://api.zippopotam.us/us/"+code, 
                     success: function(result){                               
                               var cityState = result.places[0];                                                                                             
                               if(zip=="zip"){
                                retByName("city").val(cityState["place name"]);
                                retByName("state").val(cityState["state abbreviation"]);
                               }else{
                                retByName("mcity").val(cityState["place name"]);
                                retByName("mstate").val(cityState["state abbreviation"]);
                               }
                               if(zipObj.hasClass("input-error")){
                                    classFunc(false,"input-error",zipObj);
                                    classFunc(false,"field_error",zipObj.prev());
                                    hideAlert();    
                               }                               
                        },
                        error: function(xhr,status,error){
                            if(zip=="zip"){
                              retByName("city").val("");
                              retByName("state").val("default");
                            }else{
                             retByName("mcity").val("");
                             retByName("mstate").val("default");
                            }
                            classFunc(true,"input-error",zipObj);
                            classFunc(true,"field_error",zipObj.prev());
                            $("#reqAlert").show();
                            $("#errorMsg").html("Please enter valid zipcode.");
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



   $("a").bind("mouseup", function() {
       show_close_alert = false;
   });  

   $(window).bind("beforeunload", function() {
       if (show_close_alert) {
           return "You are about to leave this page.";
       }
   });

    hideAlert();

    </script>
</body>
</html>
