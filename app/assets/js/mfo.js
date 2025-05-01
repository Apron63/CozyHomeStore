$(document).ready(function(){
	$("#menu-humburger-icon").mouseover(function(){
		$("#menu-humburger").show();
	});

	$("#menu-humburger").mouseleave(function(){
		$("#menu-humburger").hide();
	});



$('.menu-btn').on('click',function(e)
{


    e.preventDefault;
    $(this).toggleClass('menu-btn_active');
    $('.menu-nav').toggleClass('menu-nav_active');
});


});


function mailing(){
 $.ajax({
            url:     "php/mailing.php", //url страницы (action_ajax_form.php)
            type:     "POST", //метод отправки
            dataType: "html", //формат данных
            data: $("#mailing").serialize(),
            success:  function(msg){
                if (msg=="ok") {
                    alert("Спасибо! Вы подписались на рассылку.");  
                    $("#mailing")[0].reset(); 
                } else {
                    alert(msg);
                }

                
            },
            error: function (msg) {
                alert("Ошибка отправки сообщения. Попробуйте еще раз");
            }

        });
} 


function message_send(){
	if($("#politic").prop('checked')){
		 $.ajax({
					url:     "php/message_send.php", //url страницы (action_ajax_form.php)
					type:     "POST", //метод отправки
					dataType: "html", //формат данных
					data: $("#contacts-form").serialize(),
					success:  function(msg){
						if (msg=="ok") {
							alert("Спасибо! Ваша заявка принята. В ближайшее время с Вами свяжестся наш представитель.");   
							$("#contacts-form")[0].reset(); 
							$("#img-captcha").prop("src","php/captcha.php");
						} else {
							$("#img-captcha").prop("src","php/captcha.php");
							alert(msg);
						}
						
					},
					error: function (msg) {
						$("#img-captcha").prop("src","php/captcha.php");
						alert("Ошибка отправки сообщения. Попробуйте еще раз");
					}

				});
	} else{
		alert( "Согласитесь с обработкой данных ");
	}
} 



