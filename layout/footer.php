<script type="text/javascript" src="asset/js/jquery-3.3.1.min.js"></script>
<script src="asset/js/mediaelement-and-player.min.js"></script>
<script src="asset/js/playlist.js"></script>
 		<script type="text/javascript">
 		$(document).ready(function() {
 			$('.replaceAudio').hover(function() {
 				$('.replaceAudio').addClass('fa-spin');
 			}, function() {
 				$('.replaceAudio').removeClass('fa-spin');
 			});

 			$('#send_update').on("click",function(event) {searchAudio(); });

 			 $('textarea').keypress(function(e){
 			 	if (e.which == 13) {
 				searchAudio();
 				return false;
 				};
 			});

	        function searchAudio(){
	 			var keyword = $('#keySearch').val();
	 			if(keyword==''){
	 				alert('Muốn tìm truyện truyện gì thì nhập truyện đó vô rồi Enter \nMẹo: muốn xem tất cả truyện đang có thì ấn dấu cách rồi Enter');
	 				return false
	 			}
	 			$('.middle-content').append('<div class="me"><div class="chat-content">'+keyword+'</div></div>');
	 			console.log(keyword);
			    $.ajax({
		            url: 'https://audiovyvy.com/wp-api/api.php/search_audio',
		            type: 'GET',
		            dataType: 'json',
		            data: {keyword: keyword},
		        })
		        .done(function(data) {
		        	if(data==null){
		        		 $('.middle-content').append('<div class="fr"><span>Bot Audio</span><div class="chat-content">Truyện này không có nè Man</div></div>');
		        	}
	                $.each(data,function(index,value){
	                    $('.middle-content').append('<div class="fr"><span>Bot Audio</span><div class="chat-content"><a href="audiovyvy.php?meta_id='+value.meta_id+'">'+value.post_title+'</a></div></div>');
	                    $('.loading').fadeOut( 300 );
	                });
		        })
		        .fail(function() {
		            console.log("error");
		        })
		        .always(function() {
		            playSound(); 
		            
		            $('.middle-content').animate({ scrollTop:  $('.middle-content')[0].scrollHeight }, 'slow');
		         
		          
		            $('#keySearch').val('');
		        });
	        };//end searchAudio

	        function playSound(){
	        	var audio_chat_mp3 = new Audio('asset/audio/chat.mp3');
	        	audio_chat_mp3.play();
	        }
 			
	 		$('.replaceAudio').click(function(event) {
				$.ajax({
				    type:"POST",
				    url:"https://audiovyvy.com/wp-content/themes/audio_quynh_ver_two/layout/icon_truyen_nn.php",
				    dataType:"html",
				    beforeSend: function() { $('.loading').fadeIn(300); },
				      success: function(html) {
				        $("#thay_the").html(html);
				      $('.loading').fadeOut(300);
				      }
				});
	 		});
 		});
 		</script>