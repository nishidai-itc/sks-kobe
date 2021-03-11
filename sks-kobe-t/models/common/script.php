<script>
$(function(){
    var kana = $('#user_kana').val();
    
    $('#user_kana').change(function(){
        //var kana = "";
        var kana = $(this).val();
        if (kana == "") {
            var kana = "";
        }
        //$('#staff_id option[name='+kana+']').remove();
        $(".staff").each(function(index) {
          //var name = "";
          var name = $(this).attr("name");
          if (name == "ア" || name == "イ" || name == "ウ" || name == "エ" || name == "オ") {
            var name = "ア";
          }
          if (name == "カ" || name == "キ" || name == "ク" || name == "ケ" || name == "コ") {
            var name = "カ";
          }
          if (name == "サ" || name == "シ" || name == "ス" || name == "セ" || name == "ソ") {
            var name = "サ";
          }
          if (name == "タ" || name == "チ" || name == "ツ" || name == "テ" || name == "ト") {
            var name = "タ";
          }
          if (name == "ナ" || name == "ニ" || name == "ヌ" || name == "ネ" || name == "ノ") {
            var name = "ナ";
          }
          if (name == "ハ" || name == "ヒ" || name == "フ" || name == "ヘ" || name == "ホ") {
            var name = "ハ";
          }
          if (name == "マ" || name == "ミ" || name == "ム" || name == "メ" || name == "モ") {
            var name = "マ";
          }
          if (name == "ヤ" || name == "ユ" || name == "ヨ") {
            var name = "ヤ";
          }
          if (name == "ラ" || name == "リ" || name == "ル" || name == "レ" || name == "ロ") {
            var name = "ラ";
          }
          if (name == "ワ" || name == "ヲ" || name == "ン") {
            var name = "ワ";
          }
          var wrap = $(this).parents().attr("class");
          
          if(name != kana){  
              
            if(wrap !== "wrap"){
              $(this).wrap("<span class='wrap'>");
            }
          }
          if(name == kana){
            
            if(wrap == "wrap"){
              $(this).unwrap();
            }
          }
          if (kana == "") {
              $(this).unwrap();
          }
        });
    });
    
        $(".staff").each(function(index) {
          //var name = "";
          var name = $(this).attr("name");
          if (name == "ア" || name == "イ" || name == "ウ" || name == "エ" || name == "オ") {
            var name = "ア";
          }
          if (name == "カ" || name == "キ" || name == "ク" || name == "ケ" || name == "コ") {
            var name = "カ";
          }
          if (name == "サ" || name == "シ" || name == "ス" || name == "セ" || name == "ソ") {
            var name = "サ";
          }
          if (name == "タ" || name == "チ" || name == "ツ" || name == "テ" || name == "ト") {
            var name = "タ";
          }
          if (name == "ナ" || name == "ニ" || name == "ヌ" || name == "ネ" || name == "ノ") {
            var name = "ナ";
          }
          if (name == "ハ" || name == "ヒ" || name == "フ" || name == "ヘ" || name == "ホ") {
            var name = "ハ";
          }
          if (name == "マ" || name == "ミ" || name == "ム" || name == "メ" || name == "モ") {
            var name = "マ";
          }
          if (name == "ヤ" || name == "ユ" || name == "ヨ") {
            var name = "ヤ";
          }
          if (name == "ラ" || name == "リ" || name == "ル" || name == "レ" || name == "ロ") {
            var name = "ラ";
          }
          if (name == "ワ" || name == "ヲ" || name == "ン") {
            var name = "ワ";
          }
          var wrap = $(this).parents().attr("class");
          
          if(name != kana){  
              
            if(wrap !== "wrap"){
              $(this).wrap("<span class='wrap'>");
            }
          }
          if(name == kana){
            
            if(wrap == "wrap"){
              $(this).unwrap();
            }
          }
          if (kana == "") {
              $(this).unwrap();
          }
        });
    //});
});
</script>