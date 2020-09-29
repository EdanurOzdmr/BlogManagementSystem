$(document).ready(function(){
    if($('h1:first').text()!=''){
        document.title=$('h1:first').text();

    }else if ($('h3:first').text() !=''){
        document.title=$('h2:first').text();
    }
});
